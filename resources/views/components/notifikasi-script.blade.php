@auth
    <script>
        const NOTIF_URL = "{{ route('notifikasi.unread') }}";
        const NOTIF_READ_URL = "{{ route('notifikasi.read') }}";
        const NOTIF_ALL_URL = "{{ route('notifikasi.read-all') }}";
        const CSRF_TOKEN = "{{ csrf_token() }}";

        let notifData = [];

        // ── Load notifikasi ──────────────────────────────────────
        function loadNotifikasi() {
            fetch(NOTIF_URL)
                .then(r => r.json())
                .then(data => {
                    notifData = data.pengumuman;
                    renderBadge(data.count);
                    renderList(data.pengumuman);

                    // Popup hanya sekali per session
                    if (data.count > 0 && !sessionStorage.getItem('notif_popup_shown')) {
                        sessionStorage.setItem('notif_popup_shown', '1');
                        showPopup(data.pengumuman[0]);
                    }
                })
                .catch(err => console.warn('Notifikasi gagal dimuat:', err));
        }

        // ── Badge ────────────────────────────────────────────────
        function renderBadge(count) {
            const badge = document.getElementById('notif-count');
            const header = document.getElementById('notif-header-text');
            if (count > 0) {
                badge.textContent = count > 99 ? '99+' : count;
                badge.style.display = 'inline';
                header.textContent = count + ' Pengumuman Baru';
            } else {
                badge.style.display = 'none';
                header.textContent = 'Tidak ada pengumuman baru';
            }
        }

        // ── List dropdown ────────────────────────────────────────
        function renderList(items) {
            const list = document.getElementById('notif-list');
            if (!list) return;

            if (items.length === 0) {
                list.innerHTML =
                    '<div class="p-3 text-center text-muted"><i class="far fa-bell-slash mr-1"></i>Semua sudah dibaca</div>';
                return;
            }

            list.innerHTML = items.map(p => `
        <a href="#" class="dropdown-item notif-item" data-id="${p.id}"
           style="white-space:normal; border-bottom:1px solid #f0f0f0; padding:10px 16px">
            <div class="d-flex justify-content-between align-items-start">
                <strong style="font-size:12px; flex:1">${p.judul}</strong>
                <span class="badge badge-${p.prioritas === 'Urgent' ? 'danger' : (p.prioritas === 'Penting' ? 'warning' : 'info')} ml-1"
                      style="font-size:10px; flex-shrink:0">${p.prioritas}</span>
            </div>
            <div style="font-size:11px; color:#666; margin-top:3px">
                ${p.isi.length > 80 ? p.isi.substring(0, 80) + '...' : p.isi}
            </div>
            <div style="font-size:10px; color:#aaa; margin-top:3px">
                <i class="far fa-clock mr-1"></i>${p.created_at}
            </div>
        </a>
    `).join('');

            // Klik item → tandai dibaca
            document.querySelectorAll('.notif-item').forEach(el => {
                el.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.dataset.id;
                    markRead(id);
                    this.remove();
                    const remaining = document.querySelectorAll('.notif-item').length;
                    renderBadge(remaining);
                    if (remaining === 0) renderList([]);
                });
            });
        }

        // ── Mark read ────────────────────────────────────────────
        function markRead(pengumumanId) {
            fetch(NOTIF_READ_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: JSON.stringify({
                    pengumuman_id: pengumumanId
                })
            }).catch(err => console.warn('Mark read gagal:', err));
        }

        // ── Mark all read ─────────────────────────────────────────
        document.addEventListener('DOMContentLoaded', function() {
            const btnReadAll = document.getElementById('btn-read-all');
            if (btnReadAll) {
                btnReadAll.addEventListener('click', function(e) {
                    e.preventDefault();
                    fetch(NOTIF_ALL_URL, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                    }).then(() => {
                        renderBadge(0);
                        renderList([]);
                    }).catch(err => console.warn('Mark all read gagal:', err));
                });
            }
        });

        // ── Popup SweetAlert2 ─────────────────────────────────────
        function showPopup(p) {
            if (typeof Swal === 'undefined') return;

            Swal.fire({
                title: '📢 ' + p.judul,
                html: `
            <div style="text-align:left">
                <p>${p.isi}</p>
                <small class="text-muted"><i class="far fa-clock mr-1"></i>${p.created_at}</small>
            </div>
        `,
                icon: p.prioritas === 'Urgent' ? 'warning' : 'info',
                confirmButtonText: '<i class="fas fa-check mr-1"></i> Sudah Dibaca',
                showCancelButton: true,
                cancelButtonText: 'Nanti Saja',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
            }).then(result => {
                if (result.isConfirmed) {
                    markRead(p.id);
                    // Refresh badge setelah ditandai dibaca
                    setTimeout(loadNotifikasi, 500);
                }
            });
        }

        // ── Init ──────────────────────────────────────────────────
        document.addEventListener('DOMContentLoaded', function() {
            loadNotifikasi();
            // Refresh setiap 2 menit
            setInterval(loadNotifikasi, 120000);
        });
    </script>
@endauth

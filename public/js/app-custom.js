document.addEventListener("DOMContentLoaded", function () {
    // Konfirmasi hapus dengan SweetAlert2
    document.querySelectorAll(".btn-hapus").forEach(function (button) {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            const form = this.closest("form");

            Swal.fire({
                title: "Yakin ingin menghapus?",
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});

// DataTables
document.addEventListener("DOMContentLoaded", function () {
    // Inisialisasi semua tabel dengan class .datatable
    if (typeof $.fn.DataTable !== "undefined") {
        $(".datatable").DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json",
            },
            pageLength: 10,
            responsive: true,
        });
    }
});

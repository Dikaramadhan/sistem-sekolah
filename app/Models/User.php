<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'foto',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function guru()
    {
        return $this->hasOne(\App\Models\Guru::class, 'user_id');
    }

    public function siswa()
    {
        return $this->hasOne(\App\Models\Siswa::class, 'user_id');
    }

    /**
     * Ambil jenis_kelamin dari tabel guru atau siswa sesuai role.
     */
    public function getJenisKelaminAttribute(): ?string
    {
        return match ($this->role) {
            'guru'  => $this->guru?->jenis_kelamin,
            'siswa' => $this->siswa?->jenis_kelamin,
            default => null,
        };
    }

    /**
     * Ambil URL avatar placeholder sesuai jenis kelamin.
     */
    public function getAvatarAttribute(): string
    {
        if ($this->foto) {
            return Storage::url($this->foto);
        }

        return match ($this->jenis_kelamin) {
            'L' => asset('img/avatar-laki.jpg'),
            'P' => asset('img/avatar-perempuan.jpg'),
            default => asset('img/default-avatar.jpg'),
        };
    }

    /**
     * Method yang dipanggil AdminLTE untuk foto navbar.
     */
    public function adminlte_image(): string
    {
        return $this->avatar;
    }

    /**
     * Method yang dipanggil AdminLTE untuk deskripsi di dropdown.
     */
    public function adminlte_desc(): string
    {
        return ucfirst($this->role);
    }

    /**
     * Method yang dipanggil AdminLTE untuk url profil.
     */
    public function adminlte_profile_url(): string
    {
        return route('profile.edit');
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'whatsapp',
        'foto',
        'alamat',
        'password',
        'role',
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

    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }

    // 1. Cara pertama generate data menggunakan booted
    // protected static function booted()
    // {
    //     static::created(function ($user) {
    //         if (empty($user->username)) {

    //             $base = strtolower(preg_replace('/[^A-Za-z0-9]/', '', $user->name));
    //             $username = $base . mt_rand(1, 999);

    //             while (User::where('username', $username)->exists()) {
    //                 $username = $base . mt_rand(1, 999);
    //             }

    //             $user->username = $username;
    //             $user->save();
    //         }
    //     });
    // }

    // 2. Cara kedua generate data menggunakan mutator
    public function username(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                $base = strtolower(preg_replace('/[^A-Za-z0-9]/', '', $value));
                $username = $base . "-IDN-" . mt_rand(1, 999);

                while (User::where('username', $username)->exists()) {
                    $username = $base . mt_rand(1, 999);
                }

                return $username;
            }
        );
    }
    
}

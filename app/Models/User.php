<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'age',
        'dob',
        'address',
        'address',
        'role',
        'profile_picture',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ADMIN = 'admin';
    const MANAGER = 'manager';

    public static $roles = [
        self::ADMIN =>"Admin",
        self::MANAGER => "Manager"
    ];
    public static $roles_slug = [
        self::ADMIN,
        self::MANAGER
    ];

    public function role(){
        return self::$roles[$this->role];
    }
}

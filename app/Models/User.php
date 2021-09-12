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
        'user_name',
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

    public function getUsers($user_name, $password) {
        $result = $this->where('user_name', $user_name)
                       ->where('password', $password)
                       ->exists();
        return $result;
    }

    public function loginCheck($user_name)
    {
        if(is_null($user_name)) {
            return false;
        } else {
            return true;
        }
    }
}

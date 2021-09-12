<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_name',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function getUserName()
    {
        return $this->user_name;
    }

    public function getAdminUsers($user_name, $password) {
      $result = $this->where('user_name', $user_name)
                     ->where('password', $password)
                     ->exists();
      return $result;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_name',
        'category_id',
        'title',
        'content',
        'language_type',
        'create_at',
        'update_at'
    ];

    public $timestamps = true;
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'create_at';
}

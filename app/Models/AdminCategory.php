<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'category_name',
    ];

    public $timestamps = false;

    public function getCategoryData($category_id) {
        return $this->where('category_id', $category_id)->get();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'categories_blogs';

    // Primary key
    protected $primaryKey = 'id';

    // Auto-increment
    public $incrementing = true;

    // Timestamps
    public $timestamps = true;

    // Kolom yang bisa diisi
    protected $fillable = ['name', 'description'];
}

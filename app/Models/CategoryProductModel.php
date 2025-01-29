<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProductModel extends Model
{
    use HasFactory;
     // Nama tabel
     protected $table = 'ms_category';

     // Primary key
     protected $primaryKey = 'id';
 
     // Auto-increment
     public $incrementing = true;
 
     // Timestamps
     public $timestamps = true;
 
     // Kolom yang bisa diisi
     protected $fillable = ['name', 'description'];
}

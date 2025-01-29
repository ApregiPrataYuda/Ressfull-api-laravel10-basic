<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
     // Nama tabel
     protected $table = 'product';

     // Primary key
     protected $primaryKey = 'id';
 
     // Auto-increment
     public $incrementing = true;
 
     // Timestamps
     public $timestamps = true;
 
     // Kolom yang bisa diisi
     protected $fillable = ['name', 'description', 'price', 'category_id'];


     public function category() {
        return $this->belongsTo(CategoryProductModel::class, 'category_id');
    }
}

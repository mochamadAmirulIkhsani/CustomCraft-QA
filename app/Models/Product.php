<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'no_whatsapp',
        'image',
        'image2',
        'image3',
        'image4',
    ];

}

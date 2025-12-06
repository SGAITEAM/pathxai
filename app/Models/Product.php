<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // Eğer tablo adı 'products' dışında bir şeyse belirtmeliyiz
    protected $table = 'products'; // tablonun adı

    // Toplu atama (mass assignment) koruması için
    protected $fillable = [
        'id', 'c_id', 'category', 'product', 'description', 'position', 'catposition', 'img', 'extras', 'subs', 'musts', 'musts2' ,'exts', 'must_name', 'must2_name', 'allergen_one', 'allergen_two', 'catimage', 'noterase', 'sponsor', 'state'
    ];
}

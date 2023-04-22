<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartCount extends Model
{
    use HasFactory;
    protected $table = 'cartcount';
    protected $fillable = ['cart_count'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Orders extends Model
{
    protected $table = "orders";
    use HasFactory;
    protected $fillable = [
        'id',
        'orders',
        'date',
        'phone',
        'email',
        'address',
        'count',
        'cost',
        'created_at',
        'updated_at'
    ];

}

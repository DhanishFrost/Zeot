<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevenueMetric extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'brand',
        'category',
        'total_revenue',
        'date',
    ];

}

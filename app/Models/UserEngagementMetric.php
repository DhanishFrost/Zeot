<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEngagementMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'number_of_visits',
        'user_retention_rate',
        'average_order_value',
    ];
}

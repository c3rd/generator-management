<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hourmeter',
        'service_date',
        'next_service_date',
        'next_service_hourmeter',
        'employee_id',
        'generator_id',
    ];
    
}

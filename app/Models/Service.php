<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected $casts = [
        'service_date'  => 'date:d/m/Y',
    ];

    protected function hourmeter(): Attribute
    {
        return Attribute::make(
            set: fn (mixed $value) => $this->__formatToFloat($value),
        );
    }

    private function __formatToFloat($value, $decimals = 2) 
    {
        $cleanValue = preg_replace('/\D/', '', $value);
        $newValue = substr_replace($cleanValue, '.', -$decimals, 0);

        return $newValue;
    }

    public function generator(): BelongsTo
    {
        return $this->belongsTo(Generator::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Generator extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial',
        'brand',
        'model',
        'hourmeter'
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

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NumberFormatter;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'start_date',
        'end_date',
        'monthly_rate',
        'cpf',
    ];

    protected $casts = [
        'birth_date'  => 'date:d/m/Y',
        'start_date'  => 'date:d/m/Y',
        'end_date'  => 'date:d/m/Y',
    ];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => ucwords("{$this->first_name} {$this->last_name}")
        );
    }

    protected function monthlyRate(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => $this->formatMoney($value)
        );
    }

    private function formatMoney($value) {

        $fmt = new NumberFormatter('pt-BR', NumberFormatter::CURRENCY);

        return $fmt->formatCurrency($value, "BRL");

    }

}

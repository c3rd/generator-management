<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NumberFormatter;

class Employee extends Model
{
    use HasFactory;

    protected $appends = ['full_name'];

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
            get: fn (mixed $value) => $this->formatMoney($value),
            set: fn (mixed $value) => $this->formatToFloat($value),
        );
    }

    protected function cpf(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $value),
            set: fn (mixed $value) => preg_replace('/\D+/', '', $value)
        );
    }

    private function formatMoney($value) {

        $fmt = new NumberFormatter('pt-BR', NumberFormatter::CURRENCY);

        return $fmt->formatCurrency($value, "BRL");

    }

    private function formatToFloat($value, $decimals = 2) 
    {
        $cleanValue = preg_replace('/\D/', '', $value);
        $newValue = substr_replace($cleanValue, '.', -$decimals, 0);

        return $newValue;
    }

}

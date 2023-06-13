<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'identification_number',
        'identification_type',
        'email',
        'phone_number',
        'cep',
        'address',
        'address_number',
        'address_info',
        'city',
        'uf',
    ];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->first_name} {$this->last_name}",
        );
    }

    protected function identificationNumber(): Attribute
    {
        return Attribute::make(
            set: fn (mixed $value) => $this->__removeNonNumericChars($value)
        );
    }

    protected function phoneNumber(): Attribute
    {
        return Attribute::make(
            set: fn (mixed $value) => $this->__removeNonNumericChars($value)
        );
    }

    protected function cep(): Attribute
    {
        return Attribute::make(
            set: fn (mixed $value) => $this->__removeNonNumericChars($value)
        );
    }

    private function __removeNonNumericChars($value)
    {
        return preg_replace('/\D+/', '', $value);
    }
}

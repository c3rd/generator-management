<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('identification_number');
            $table->string('identification_type');
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('cep')->nullable();
            $table->string('address')->nullable();
            $table->string('address_number')->nullable();
            $table->string('address_info')->nullable();
            $table->string('city')->nullable();
            $table->string('uf')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

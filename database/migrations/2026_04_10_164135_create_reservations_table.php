<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->date('date');
            $table->integer('session');
            $table->integer('guest_count');
            $table->enum('type', ['VIP', 'REGULAR']);
            $table->enum('area', ['RESTO', 'MONSTER']);
            $table->boolean('dp_status')->default(false);
            $table->enum('status', ['pending', 'done', 'canceled'])->default('pending');
            $table->timestamps();
        });
    }
};

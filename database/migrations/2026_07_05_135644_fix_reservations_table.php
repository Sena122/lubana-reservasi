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
        Schema::table('reservations', function (Blueprint $table) {
            // 1. Ubah enum status untuk menambahkan 'confirmed'
            $table->enum('status', ['pending', 'confirmed', 'done', 'canceled'])
                  ->default('pending')
                  ->change();
            
            // 2. Tambahkan payment_proof untuk upload bukti DP
            $table->string('payment_proof')->nullable()->after('other_note');
            
            // 3. Tambahkan created_by untuk audit siapa yang membuat reservasi
            $table->foreignId('created_by')->nullable()->after('payment_proof')
                  ->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Kembalikan ke status awal
            $table->enum('status', ['pending', 'done', 'canceled'])
                  ->default('pending')
                  ->change();
            
            $table->dropColumn(['payment_proof', 'created_by']);
        });
    }
};
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
        Schema::table('reservation_menu', function (Blueprint $table) {
            // Tambahkan kolom subtotal jika belum ada
            if (!Schema::hasColumn('reservation_menu', 'subtotal')) {
                $table->decimal('subtotal', 15, 2)->nullable()->after('quantity');
            }
            
            // Tambahkan kolom price jika belum ada
            if (!Schema::hasColumn('reservation_menu', 'price')) {
                $table->decimal('price', 15, 2)->nullable()->after('quantity');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservation_menu', function (Blueprint $table) {
            $table->dropColumn(['subtotal', 'price']);
        });
    }
};
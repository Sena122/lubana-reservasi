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
            // Menambahkan kolom baru setelah kolom pendukungnya masing-masing
            $table->string('institution')->nullable()->after('phone');
            $table->text('address')->nullable()->after('institution');
            $table->time('booking_time')->nullable()->after('date');
            $table->string('saung_number')->nullable()->after('session');
            $table->decimal('down_payment', 12, 2)->default(0)->after('guest_count');
            $table->text('menu_selection')->nullable()->after('down_payment');
            $table->text('special_note')->nullable()->after('menu_selection');
            $table->text('other_note')->nullable()->after('special_note');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Mengaktifkan dropColumn agar aman saat melakukan rollback/fresh
            $table->dropColumn([
                'institution',
                'address',
                'booking_time',
                'saung_number',
                'down_payment',
                'menu_selection',
                'special_note',
                'other_note'
            ]);
        });
    }
};
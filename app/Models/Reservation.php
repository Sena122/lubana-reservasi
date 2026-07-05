<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    /**
     * Properti mass assignment fillable disesuaikan dengan Form Baru
     */
    protected $fillable = [
        'name',
        'institution',
        'phone',
        'address',
        'date',
        'booking_time',
        'session',
        'guest_count',
        'type',
        'area',
        'saung_number',
        'menu_selection',
        'special_note',
        'other_note',
        'dp_status',
        'down_payment',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'dp_status' => 'boolean',
        'down_payment' => 'float',
        'status' => 'string', // ⭐ TAMBAHKAN INI
    ];

    // ⭐ TAMBAHKAN KONSTANTA STATUS
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_DONE = 'done';
    const STATUS_CANCELED = 'canceled';

    // ⭐ TAMBAHKAN METHOD UNTUK VALIDASI STATUS
    public static function getValidStatuses()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_CONFIRMED,
            self::STATUS_DONE,
            self::STATUS_CANCELED,
        ];
    }

    // ⭐ TAMBAHKAN METHOD UNTUK LABEL STATUS
    public static function getStatusLabels()
    {
        return [
            self::STATUS_PENDING => 'Menunggu',
            self::STATUS_CONFIRMED => 'Disetujui',
            self::STATUS_DONE => 'Selesai',
            self::STATUS_CANCELED => 'Dibatalkan',
        ];
    }

    // ⭐ TAMBAHKAN METHOD UNTUK COLOR STATUS
    public static function getStatusColors()
    {
        return [
            self::STATUS_PENDING => 'border-amber-500 bg-amber-50 text-amber-700',
            self::STATUS_CONFIRMED => 'border-blue-500 bg-blue-50 text-blue-700',
            self::STATUS_DONE => 'border-emerald-500 bg-emerald-50 text-emerald-700',
            self::STATUS_CANCELED => 'border-rose-500 bg-rose-50 text-rose-700',
        ];
    }

    // ⭐ TAMBAHKAN METHOD UNTUK CEK STATUS
    public function isValidStatus($status)
    {
        return in_array($status, self::getValidStatuses());
    }

    // ⭐ TAMBAHKAN SCOPE UNTUK FILTER STATUS
    public function scopeStatus($query, $status)
    {
        if ($status && in_array($status, self::getValidStatuses())) {
            return $query->where('status', $status);
        }
        return $query;
    }

    // ⭐ TAMBAHKAN ACCESSOR UNTUK LABEL STATUS
    public function getStatusLabelAttribute()
    {
        $labels = self::getStatusLabels();
        return $labels[$this->status] ?? ucfirst($this->status);
    }

    // ⭐ TAMBAHKAN ACCESSOR UNTUK COLOR STATUS
    public function getStatusColorAttribute()
    {
        $colors = self::getStatusColors();
        return $colors[$this->status] ?? 'border-gray-500 bg-gray-50 text-gray-700';
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'reservation_menu')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
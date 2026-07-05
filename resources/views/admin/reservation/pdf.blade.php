<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Formulir_Booking_LS-{{ $reservation->id }}</title>
    <style>
        /* Pengaturan Dasar Kertas Cetak DomPDF */
        @page {
            size: a4 portrait;
            margin: 20mm 15mm 20mm 15mm;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1a1a1a;
            line-height: 1.4;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        /* HEADER DOKUMEN */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px solid #1a1a1a;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .title-main {
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
            color: #111111;
        }

        .subtitle-main {
            font-size: 10px;
            color: #666666;
            text-transform: uppercase;
            font-weight: bold;
            margin-top: 3px;
        }

        .brand-text {
            font-size: 16px;
            font-weight: bold;
            color: #059669;
            text-transform: uppercase;
            text-align: right;
            margin: 0;
        }

        .brand-sub {
            font-size: 9px;
            color: #888888;
            text-transform: uppercase;
            text-align: right;
            margin-top: 2px;
        }

        /* STRUKTUR BLOK DATA */
        .section-title {
            font-size: 10px;
            font-weight: bold;
            color: #059669;
            text-transform: uppercase;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 4px;
            margin-top: 20px;
            margin-bottom: 12px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .data-table td {
            padding: 6px 0;
            vertical-align: top;
        }

        .label-text {
            width: 30%;
            font-size: 9px;
            color: #777777;
            text-transform: uppercase;
            font-weight: bold;
        }

        .value-text {
            width: 70%;
            font-size: 12px;
            font-weight: bold;
            color: #222222;
        }

        .value-text.uppercase-val {
            text-transform: uppercase;
        }

        /* TABEL RINCIAN MENU */
        .menu-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .menu-table th {
            background-color: #f3f4f6;
            color: #374151;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            text-align: left;
            padding: 6px 10px;
            border: 1px solid #e5e7eb;
        }

        .menu-table td {
            padding: 6px 10px;
            border: 1px solid #e5e7eb;
            font-size: 11px;
            color: #1a1a1a;
        }

        .menu-table .text-right {
            text-align: right;
        }

        .menu-table .text-center {
            text-align: center;
        }

        .menu-table .total-row {
            font-weight: bold;
            background-color: #f9fafb;
        }

        /* BOX DOWN PAYMENT */
        .payment-box {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            padding: 15px;
            margin-top: 15px;
            overflow: hidden;
        }

        .payment-title {
            font-size: 9px;
            font-weight: bold;
            color: #166534;
            text-transform: uppercase;
        }

        .payment-amount {
            font-size: 18px;
            font-weight: bold;
            color: #15803d;
            margin-top: 2px;
        }

        .payment-status {
            float: right;
            background-color: #15803d;
            color: #ffffff;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 5px 10px;
            margin-top: 5px;
        }

        /* ============================================
           TANDA TANGAN - DENGAN 2 KOLOM
           ============================================ */
        .signature-container {
            width: 100%;
            margin-top: 40px;
            border-collapse: collapse;
        }

        .signature-container td {
            padding: 10px 20px;
            vertical-align: bottom;
        }

        .signature-box {
            text-align: center;
            font-size: 11px;
        }

        .signature-box .label {
            font-size: 9px;
            color: #777777;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .signature-box .line {
            margin-top: 50px;
            border-top: 1px solid #1a1a1a;
            font-weight: bold;
            text-transform: uppercase;
            padding-top: 4px;
            font-size: 10px;
            color: #333333;
        }

        .signature-box .city-date {
            font-size: 10px;
            color: #555555;
            margin-bottom: 4px;
        }

        .signature-box .sub-label {
            font-size: 8px;
            color: #999999;
            margin-top: 2px;
        }

        /* Divider vertikal antara kolom TTD */
        .signature-divider {
            width: 1px;
            background-color: #e5e7eb;
        }

        /* ============================================
           FOOTER
           ============================================ */
        .footer-note {
            text-align: center;
            font-size: 8px;
            color: #aaaaaa;
            margin-top: 20px;
            border-top: 1px solid #e5e7eb;
            padding-top: 8px;
            letter-spacing: 0.3px;
        }

        /* ============================================
           UTILITY
           ============================================ */
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .mt-1 {
            margin-top: 4px;
        }

        .mb-1 {
            margin-bottom: 4px;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        /* Status badge untuk DP */
        .status-badge {
            display: inline-block;
            background-color: #15803d;
            color: #ffffff;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 4px;
        }

        .status-badge.pending {
            background-color: #f59e0b;
        }

        .status-badge.canceled {
            background-color: #ef4444;
        }
    </style>
</head>

<body>

    <!-- ============================================
    HEADER
    ============================================ -->
    <table class="header-table">
        <tr>
            <td style="width: 60%;">
                <h1 class="title-main">Formulir Booking Tempat</h1>
                <div class="subtitle-main">ID Dokumen Digital: LS-{{ str_pad($reservation->id, 4, '0', STR_PAD_LEFT) }}</div>
            </td>
            <td style="width: 40%; text-align: right;">
                <div class="brand-text">Lubana Sengkol</div>
                <div class="brand-sub">Sistem Arsip Pemesanan Tempat</div>
            </td>
        </tr>
    </table>

    <!-- ============================================
    I. IDENTITAS PELANGGAN
    ============================================ -->
    <div class="section-title">I. Informasi Identitas Pelanggan</div>
    <table class="data-table">
        <tr>
            <td class="label-text">Nama Pelanggan</td>
            <td class="value-text uppercase-val">{{ $reservation->name }}</td>
        </tr>
        <tr>
            <td class="label-text">No. Kontak / WA</td>
            <td class="value-text">{{ $reservation->phone }}</td>
        </tr>
        <tr>
            <td class="label-text">Instansi / Perusahaan</td>
            <td class="value-text uppercase-val">{{ $reservation->institution ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label-text">Alamat Pemesan</td>
            <td class="value-text uppercase-val" style="font-weight: normal; color: #4b5563;">{{ $reservation->address ?? '-' }}</td>
        </tr>
    </table>

    <!-- ============================================
    II. JADWAL & LOKASI
    ============================================ -->
    <div class="section-title">II. Jadwal Kedatangan &amp; Alokasi Tempat</div>
    <table class="data-table">
        <tr>
            <td class="label-text">Tanggal Kunjungan</td>
            <td class="value-text">{{ \Carbon\Carbon::parse($reservation->date)->translatedFormat('l, d F Y') }}</td>
        </tr>
        <tr>
            <td class="label-text">Jam Kedatangan</td>
            <td class="value-text">{{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }} WIB</td>
        </tr>
        <tr>
            <td class="label-text">Jumlah Personil (Pax)</td>
            <td class="value-text">{{ $reservation->guest_count }} Orang</td>
        </tr>
        <tr>
            <td class="label-text">Sesi Acara</td>
            <td class="value-text uppercase-val">Sesi {{ $reservation->session }}</td>
        </tr>
        <tr>
            <td class="label-text">Area Penempatan</td>
            <td class="value-text uppercase-val" style="color: #2563eb;">{{ $reservation->area }} AREA</td>
        </tr>
        <tr>
            <td class="label-text">Nomor Saung / Meja</td>
            <td class="value-text uppercase-val" style="color: #7c3aed;">{{ $reservation->saung_number ?? 'Bebas / Menyesuaikan' }}</td>
        </tr>
        <tr>
            <td class="label-text">Tipe Layanan</td>
            <td class="value-text uppercase-val" style="color: #059669;">{{ $reservation->type ?? 'REGULAR' }}</td>
        </tr>
    </table>

    <!-- ============================================
    III. PESANAN MENU
    ============================================ -->
    <div class="section-title">III. Rincian Pilihan Menu Restoran</div>

    @if($reservation->menus && $reservation->menus->count() > 0)
    <table class="menu-table">
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 47%;">Nama Menu Pesanan</th>
                <th style="width: 18%; text-align: right;">Harga Satuan</th>
                <th style="width: 10%; text-align: center;">Qty</th>
                <th style="width: 20%; text-align: right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotalMenu = 0; @endphp
            @foreach($reservation->menus as $index => $menu)
            @php
            $qty = $menu->pivot->quantity ?? 1;
            $subtotal = $menu->price * $qty;
            $grandTotalMenu += $subtotal;
            @endphp
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td style="font-weight: bold;">{{ $menu->name }}</td>
                <td class="text-right">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                <td class="text-center">{{ $qty }}</td>
                <td class="text-right" style="font-weight: bold;">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="4" class="text-right" style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Total Akumulasi Menu:
                </td>
                <td class="text-right" style="color: #059669; font-size: 13px;">
                    Rp {{ number_format($grandTotalMenu, 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>
    @else
    <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; padding: 12px 15px; font-size: 11px; color: #6b7280; font-style: italic; margin-bottom: 15px;">
        Tidak ada pemilihan menu khusus dalam arsip (Pemesanan Ala Carte langsung dilakukan di lokasi).
    </div>
    @endif

    <!-- ============================================
    IV. CATATAN
    ============================================ -->
    <table class="data-table" style="margin-top: 5px;">
        <tr>
            <td class="label-text" style="width: 20%;">Catatan Khusus Acara</td>
            <td class="value-text" style="font-size: 11px; font-weight: normal;">{{ $reservation->special_note ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label-text" style="width: 20%;">Catatan Lainnya</td>
            <td class="value-text" style="font-size: 11px; font-weight: normal;">{{ $reservation->other_note ?? '-' }}</td>
        </tr>
    </table>

    <!-- ============================================
    V. DOWN PAYMENT
    ============================================ -->
    <div class="payment-box">
        <div class="payment-status">
            {{ $reservation->dp_status ? '✅ LUNAS / SAH' : '⏳ BELUM BAYAR' }}
        </div>
        <div class="payment-title">Nilai Panjar / Uang Muka (Down Payment)</div>
        <div class="payment-amount">Rp {{ number_format($reservation->down_payment ?? 0, 0, ',', '.') }}</div>
    </div>

    <!-- ============================================
    VI. TANDA TANGAN - 2 KOLOM
    ============================================ -->
    <div class="section-title" style="margin-top: 25px;">VI. Pengesahan &amp; Tanda Tangan</div>

    <table class="signature-container">
        <tr>
            <!-- Kolom Kiri: Pengunjung / Pelanggan -->
            <td style="width: 48%; text-align: center; vertical-align: bottom; padding-right: 15px;">
                <div class="signature-box">
                    <div class="label">Pengunjung / Pelanggan</div>
                    <div class="line" style="margin-top: 45px; width: 80%; margin-left: auto; margin-right: auto;">
                        (........................................)
                    </div>
                    <div class="sub-label">Nama Lengkap &amp; Tanda Tangan</div>
                    <div style="margin-top: 6px; font-size: 9px; color: #999;">
                        <span style="font-weight: bold;">Nama:</span> _________________________
                    </div>
                </div>
            </td>

            <!-- Divider Vertikal -->
            <td style="width: 2%; vertical-align: bottom;">
                <div style="width: 1px; height: 120px; background-color: #e5e7eb; margin: 0 auto;"></div>
            </td>

            <!-- Kolom Kanan: Admin / Petugas -->
            <td style="width: 50%; text-align: center; vertical-align: bottom; padding-left: 15px;">
                <div class="signature-box">
                    <div class="city-date" style="text-align: center;">
                        Tangerang Selatan, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                    </div>
                    <div class="label">Petugas Admin / Kasir</div>
                    <div class="line" style="margin-top: 25px; width: 80%; margin-left: auto; margin-right: auto;">
                        (........................................)
                    </div>
                    <div class="sub-label">Nama Lengkap &amp; Tanda Tangan</div>
                    <div style="margin-top: 6px; font-size: 9px; color: #999;">
                        <span style="font-weight: bold;">Nama:</span> _________________________
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <!-- ============================================
    VII. SYARAT & KETENTUAN
    ============================================ -->
    <div class="section-title" style="margin-top: 20px;">VII. Syarat &amp; Ketentuan</div>

    <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; padding: 12px 16px; font-size: 9px; color: #4b5563; border-radius: 4px;">
        <ol style="margin: 0; padding-left: 18px;">
            <li style="padding: 2px 0;">Pembayaran DP wajib dilakukan maksimal H-1 sebelum tanggal kunjungan.</li>
            <li style="padding: 2px 0;">Pembatalan H-3 sebelum tanggal kunjungan, DP dapat dikembalikan 100%.</li>
            <li style="padding: 2px 0;">Pembatalan H-2 sebelum tanggal kunjungan, DP dapat dikembalikan 50%.</li>
            <li style="padding: 2px 0;">Pembatalan H-1 atau hari-H, DP tidak dapat dikembalikan.</li>
            <li style="padding: 2px 0;">Konsumsi menu yang sudah dipesan tidak dapat dibatalkan setelah H-1.</li>
            <li style="padding: 2px 0;">Area pemancingan monster fish wajib mengikuti aturan yang berlaku.</li>
            <li style="padding: 2px 0;">Dokumen ini sebagai bukti reservasi yang sah dan mengikat.</li>
        </ol>
    </div>

    <!-- ============================================
    FOOTER
    ============================================ -->
    <div class="footer-note">
        Sistem Informasi Reservasi Lubana Sengkol &bull; Dokumen dicetak otomatis oleh sistem
        &bull; {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}
    </div>

</body>

</html>
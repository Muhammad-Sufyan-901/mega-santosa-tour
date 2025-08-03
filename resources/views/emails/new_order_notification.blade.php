<!DOCTYPE html>
<html>

<head>
    <title>Pesanan Baru - Mega Santosa Tour</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #48A0CB, #1B5DB9);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 20px;
            background: #f9f9f9;
        }

        .order-details {
            background: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Pesanan Baru Diterima!</h1>
            <p>{{ $order_date }}</p>
        </div>

        <div class="content">
            <h2>Detail Pesanan</h2>

            <div class="order-details">
                <h3>Informasi Layanan</h3>
                <p><strong>Layanan:</strong> {{ $service->title }}</p>
                <p><strong>Jenis:</strong> {{ $service->type_of_service }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($service->price, 0, ',', '.') }}</p>
            </div>

            <div class="order-details">
                <h3>Informasi Pelanggan</h3>
                <p><strong>Nama:</strong> {{ $customer_name }}</p>
                <p><strong>Email:</strong> {{ $customer_email }}</p>
                <p><strong>WhatsApp:</strong> {{ $customer_whatsapp }}</p>
                <p><strong>Jumlah Peserta:</strong> {{ $participants }} orang</p>
                <p><strong>Lokasi Pickup:</strong> {{ $pickup_location }}</p>
            </div>

            <div class="order-details">
                <h3>Jadwal Perjalanan</h3>
                <p><strong>Tanggal Mulai:</strong> {{ $start_date }}</p>
                <p><strong>Tanggal Selesai:</strong> {{ $end_date }}</p>
                <p><strong>Durasi:</strong> {{ $duration }} hari</p>
            </div>

            @if ($message)
                <div class="order-details">
                    <h3>Pesan Tambahan</h3>
                    <p>{{ $message }}</p>
                </div>
            @endif
        </div>

        <div class="footer">
            <p>Silakan hubungi pelanggan segera untuk konfirmasi pesanan.</p>
            <p><strong>Mega Santosa Tour</strong></p>
        </div>
    </div>
</body>

</html>

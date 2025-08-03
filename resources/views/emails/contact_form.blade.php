<!DOCTYPE html>
<html>

<head>
    <title>Pesan Kontak Baru - Mega Santosa Tour</title>
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

        .message-details {
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
            <h1>Pesan Kontak Baru</h1>
        </div>

        <div class="content">
            <div class="message-details">
                <h3>Detail Pengirim</h3>
                <p><strong>Nama:</strong> {{ $name }}</p>
                <p><strong>Email:</strong> {{ $email }}</p>
                <p><strong>Subjek:</strong> {{ $subject }}</p>
            </div>

            <div class="message-details">
                <h3>Pesan</h3>
                <p>{{ $message }}</p>
            </div>
        </div>

        <div class="footer">
            <p><strong>Mega Santosa Tour</strong></p>
        </div>
    </div>
</body>

</html>

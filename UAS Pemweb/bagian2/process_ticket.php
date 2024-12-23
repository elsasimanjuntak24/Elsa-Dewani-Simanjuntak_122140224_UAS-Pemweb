<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan server database Anda
$username = "root";        // Ganti dengan username database Anda
$password = "";            // Ganti dengan password database Anda
$dbname = "ticket_booking"; // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menutup koneksi (tidak ada pemrosesan database dalam halaman ini)
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesai Pemesanan Tiket</title>
    <style>
        /* Gaya dasar untuk halaman */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        /* Gaya untuk judul halaman */
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        /* Gaya untuk deskripsi */
        p {
            font-size: 1.2em;
            margin-bottom: 30px;
            text-align: center;
            max-width: 600px;
        }

        /* Gaya untuk tombol */
        .finish-btn {
            background: linear-gradient(to right, #4CAF50, #2E7D32);
            color: #fff;
            padding: 15px 30px;
            font-size: 1.2em;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            transition: background 0.3s ease, transform 0.2s ease;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        .finish-btn:hover {
            background: linear-gradient(to right, #2E7D32, #4CAF50);
            transform: scale(1.05);
        }

        .finish-btn:active {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <h1>Terima Kasih!</h1>
    <p>Pemesanan tiket Anda telah berhasil diproses. Silakan klik tombol di bawah ini untuk kembali ke halaman utama.</p>
    <a href="../bagian1/home.html" class="finish-btn">Selesai</a>
</body>
</html>
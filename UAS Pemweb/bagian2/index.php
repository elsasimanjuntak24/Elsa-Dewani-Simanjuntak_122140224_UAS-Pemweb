<?php
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket</title>
    <style>
         body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Gaya untuk judul halaman */
        h1 {
            color: #fff;
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        /* Gaya untuk formulir */
        form {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        /* Gaya untuk label elemen formulir */
        label {
            display: block;
            margin: 15px 0 5px;
            font-weight: bold;
        }

        /* Gaya untuk input dan tombol */
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        /* Gaya khusus untuk input tipe radio dan checkbox */
        input[type="radio"], input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
        }

        /* Gaya untuk tombol dengan efek hover */
        button {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: linear-gradient(to right, #2575fc, #6a11cb);
        }

        /* Gaya untuk tabel */
        table {
            width: 100%;
            max-width: 800px;
            margin-top: 30px;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 15px;
            text-align: center;
            font-size: 1em;
        }

        th {
            background: #2575fc;
            color: #fff;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        /* Gaya highlight saat fokus */
        .highlight {
            background-color: #e8f0fe !important;
        }
        .radio{
            display: flex;
            margin-left: 150px;
        
        body { font-family: 'Poppins', sans-serif; background: #f0f0f0; padding: 20px; text-align: center; }
        h1 { color: #333; }
        form { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2); width: 100%; max-width: 400px; }
        label, input, button { width: 100%; padding: 10px; margin: 5px 0; }
        button { background: #2575fc; color: white; border: none; cursor: pointer; }
        button:hover { background: #6a11cb; }
    </style>
</head>
<body>
    <h1>Pemesanan Tiket</h1>
    <form action="process_ticket.php" method="POST">
        <label for="name">Nama Lengkap:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="ticketType">Jenis Tiket:</label>
        <input type="radio" id="vip" name="ticketType" value="VIP" required> VIP
        <input type="radio" id="regular" name="ticketType" value="Regular" required> Regular

        <label for="quantity">Jumlah Tiket:</label>
        <input type="number" id="quantity" name="quantity" min="1" required>

        <label for="terms"><input type="checkbox" id="terms" name="terms" required> Saya setuju dengan syarat dan ketentuan</label>

        <button type="submit">Pesan Tiket</button>
    </form>
</body>
</html>
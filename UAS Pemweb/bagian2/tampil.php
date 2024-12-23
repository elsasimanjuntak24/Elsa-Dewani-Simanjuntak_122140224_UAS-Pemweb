<?php
// Mulai session untuk cek login (jika perlu)
session_start();

// Koneksi ke database
$host = "localhost"; // Ganti dengan host Anda
$username = "root";  // Ganti dengan username database Anda
$password = "";      // Ganti dengan password database Anda
$dbname = "ticket_booking"; // Nama database

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel booking
$sql = "SELECT id, name, email, ticket_type, quantity FROM bookings";
$result = $conn->query($sql);

// Mengecek apakah query berhasil
if (!$result) {
    die("Error: " . $conn->error);  // Menampilkan pesan kesalahan query jika ada
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemesanan Tiket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #2575fc;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td {
            background-color: #f2f2f2;
        }

        .back-btn {
            display: inline-block;
            margin-top: 30px;
            background-color: #ff6f61;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #ff4d38;
        }
    </style>
</head>
<body>

    <h1>Data Pemesanan Tiket</h1>

    <?php
    // Mengecek apakah ada data dalam database
    if ($result->num_rows > 0) {
        // Menampilkan data dalam tabel HTML
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jenis Tiket</th>
                    <th>Jumlah Tiket</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["ticket_type"] . "</td>
                    <td>" . $row["quantity"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Tidak ada data yang tersedia.</p>";
    }
    ?>

    <a href="../bagian1/home.html" class="back-btn">Kembali ke Halaman Utama</a>

</body>
</html>

<?php
// Menutup koneksi
$conn->close();
?>
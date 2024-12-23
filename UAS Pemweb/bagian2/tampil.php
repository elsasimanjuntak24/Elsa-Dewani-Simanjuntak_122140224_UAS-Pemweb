<?php
// Mulai session untuk cek login (jika perlu)
session_start();

// Fungsi untuk menetapkan cookie
function setCookieData($name, $value, $expire) {
    setcookie($name, $value, time() + $expire, "/");
}

// Fungsi untuk mendapatkan cookie
function getCookieData($name) {
    return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
}

// Fungsi untuk menghapus cookie
function deleteCookieData($name) {
    setcookie($name, "", time() - 3600, "/");
}

// Set cookie before any output
setCookieData("username", "JohnDoe", 3600);

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

// Proses penghapusan data
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM bookings WHERE id = $delete_id";

    if ($conn->query($delete_sql) === TRUE) {
        // Re-sequence the IDs after deletion to remove gaps
        $reset_sql = "SET @count = 0; 
                      UPDATE bookings SET id = (@count := @count + 1)";
        $conn->query($reset_sql);

        // Reset the AUTO_INCREMENT value to the next available number
        $reset_auto_increment = "ALTER TABLE bookings AUTO_INCREMENT = 1";
        $conn->query($reset_auto_increment);

        echo "<script>alert('Data berhasil dihapus dan ID telah di-reset!'); window.location.href = 'tampil.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
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

        .delete-btn {
            background-color: #e74c3c;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
        }

        .delete-btn:hover {
            background-color: #c0392b;
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
                    <th>Aksi</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["ticket_type"] . "</td>
                    <td>" . $row["quantity"] . "</td>
                    <td><a href='?delete_id=" . $row["id"] . "' class='delete-btn'>Hapus</a></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Tidak ada data yang tersedia.</p>";
    }

    // Display cookie data
    echo "<p>Cookie 'username' ditetapkan dengan nilai: " . getCookieData("username") . "</p>";
    ?>

    <a href="../bagian1/home.html" class="back-btn">Kembali ke Halaman Utama</a>

</body>
</html>

<?php
// Menutup koneksi
$conn->close();
?>

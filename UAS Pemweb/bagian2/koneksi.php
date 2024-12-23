<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan server database Anda
$username = "root";        // Ganti dengan username database Anda
$password = "";            // Ganti dengan password database Anda
$dbname = "ticket_booking"; // Nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk menambahkan data
function tambahData($conn, $name, $email, $ticketType, $quantity) {
    $stmt = $conn->prepare("INSERT INTO bookings (name, email, ticket_type, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $email, $ticketType, $quantity);

    if ($stmt->execute()) {
        echo "Data berhasil ditambahkan.<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }
    $stmt->close();
}

// Fungsi untuk membaca data
function bacaData($conn) {
    $sql = "SELECT * FROM bookings";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10'>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jenis Tiket</th>
                    <th>Jumlah</th>
                    <th>Waktu Pemesanan</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["ticket_type"] . "</td>
                    <td>" . $row["quantity"] . "</td>
                    <td>" . $row["created_at"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data yang tersedia.<br>";
    }
}

// Fungsi untuk memperbarui data
function perbaruiData($conn, $id, $name, $email, $ticketType, $quantity) {
    $stmt = $conn->prepare("UPDATE bookings SET name = ?, email = ?, ticket_type = ?, quantity = ? WHERE id = ?");
    $stmt->bind_param("sssii", $name, $email, $ticketType, $quantity, $id);

    if ($stmt->execute()) {
        echo "Data berhasil diperbarui.<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }
    $stmt->close();
}

// Fungsi untuk menghapus data
function hapusData($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Data berhasil dihapus.<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }
    $stmt->close();
}

// Contoh penggunaan fungsi
echo "<h2>Contoh Operasi Database</h2>";

// Menambahkan data
tambahData($conn, "John Doe", "john@example.com", "VIP", 2);
tambahData($conn, "Jane Doe", "jane@example.com", "Regular", 3);

// Membaca data
echo "<h3>Data Booking</h3>";
bacaData($conn);

// Memperbarui data
perbaruiData($conn, 1, "John Smith", "johnsmith@example.com", "Regular", 4);

// Membaca data setelah diperbarui
echo "<h3>Data Booking Setelah Diperbarui</h3>";
bacaData($conn);

// Menghapus data
hapusData($conn, 2);

// Membaca data setelah dihapus
echo "<h3>Data Booking Setelah Dihapus</h3>";
bacaData($conn);

// Menutup koneksi
$conn->close();
?>
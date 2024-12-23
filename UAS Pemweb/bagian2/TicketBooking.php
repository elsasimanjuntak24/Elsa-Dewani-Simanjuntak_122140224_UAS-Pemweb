<?php

class TicketBooking {
    private $conn;
    
    public function __construct($host, $username, $password, $dbname) {
        // Membuka koneksi ke database
        $this->conn = new mysqli($host, $username, $password, $dbname);

        // Memeriksa koneksi
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function saveBooking($name, $email, $ticketType, $quantity) {
        // Mendapatkan informasi pengguna (IP dan browser)
        $userIP = $_SERVER['REMOTE_ADDR'];
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        // Menyimpan data pemesanan
        $stmt = $this->conn->prepare("INSERT INTO bookings (name, email, ticket_type, quantity, user_ip, user_agent) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $email, $ticketType, $quantity, $userIP, $userAgent);
        $stmt->execute();
        $stmt->close();

        return "Pemesanan berhasil!";
    }

    public function getBookingDetails($id) {
        // Mengambil detail pemesanan berdasarkan ID
        $stmt = $this->conn->prepare("SELECT * FROM bookings WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $booking = $result->fetch_assoc();
        $stmt->close();
        
        return $booking;
    }

    public function closeConnection() {
        // Menutup koneksi database
        $this->conn->close();
    }
}
?>

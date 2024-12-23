<?php
include_once 'TicketBooking.php';

// Mengambil ID pemesanan dari URL
$bookingId = $_GET['id'] ?? 0;

if ($bookingId) {
    // Membuat objek dan mengambil detail pemesanan
    $ticketBooking = new TicketBooking("localhost", "root", "", "ticket_booking");
    $bookingDetails = $ticketBooking->getBookingDetails($bookingId);

    if ($bookingDetails) {
        // Menampilkan detail pemesanan
        echo "<h1>Detail Pemesanan Tiket</h1>";
        echo "<p><strong>Nama:</strong> " . $bookingDetails['name'] . "</p>";
        echo "<p><strong>Email:</strong> " . $bookingDetails['email'] . "</p>";
        echo "<p><strong>Jenis Tiket:</strong> " . $bookingDetails['ticket_type'] . "</p>";
        echo "<p><strong>Jumlah Tiket:</strong> " . $bookingDetails['quantity'] . "</p>";
        echo "<p><strong>Alamat IP:</strong> " . $bookingDetails['user_ip'] . "</p>";
        echo "<p><strong>Jenis Browser:</strong> " . $bookingDetails['user_agent'] . "</p>";
    } else {
        echo "<p>Data pemesanan tidak ditemukan.</p>";
    }

    // Menutup koneksi
    $ticketBooking->closeConnection();
} else {
    echo "<p>ID pemesanan tidak valid.</p>";
}
?>

<?php
// Sambungkan ke database
$conn = new mysqli('localhost', 'sewtxxbj_kasirku', 'apaajalah123', 'sewtxxbj_kasirku');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Logika untuk memperbarui kolom status
$sql = "UPDATE user SET status = 'Tidak Aktif' WHERE DATE_ADD(date_updated, INTERVAL 1 HOUR) < NOW()";
$result = $conn->query($sql);

if ($result) {
    echo "Kolom status berhasil diperbarui.";
} else {
    echo "Gagal memperbarui kolom status: " . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
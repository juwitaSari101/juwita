<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "daftar_pesanan_wisata"; // Ganti dengan nama database Anda

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$nama = $_POST['nama'];
$nomor_hp = $_POST['nomor_hp'];
$tanggal_pesan = $_POST['tanggal_pesan'];
$paket_penginapan = isset($_POST['paket'][0]) ? true : false;
$paket_transportasi = isset($_POST['paket'][1]) ? true : false;
$paket_servis = isset($_POST['paket'][2]) ? true : false;
$jumlah_peserta = $_POST['jumlah_peserta'];
$waktu_perjalanan = $_POST['waktu_perjalanan'];
$harga_paket = str_replace(['Rp ', '.'], ['', ''], $_POST['harga_paket']);
$jumlah_tagihan = str_replace(['Rp ', '.'], ['', ''], $_POST['jumlah_tagihan']);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO pesanan_wisata (nama, nomor_hp, tanggal_pesan, paket_penginapan, paket_transportasi, paket_servis, jumlah_peserta, waktu_perjalanan, harga_paket, jumlah_tagihan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiisiddi", $nama, $nomor_hp, $tanggal_pesan, $paket_penginapan, $paket_transportasi, $paket_servis, $jumlah_peserta, $waktu_perjalanan, $harga_paket, $jumlah_tagihan);

// Execute the statement
if ($stmt->execute()) {
    echo "Data berhasil disimpan!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>

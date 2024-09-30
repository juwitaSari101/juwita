<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempat Pariwisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <div class="medsos">
        <div class="container">
            <ul>
                <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-square-youtube"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
    <header>
        <!--navbar-->
        <div class="container">
            <h1><a href="index.html">Jalan-Jalan</a></h1>
            <ul>
                <li class="active"><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="wisata.html">Wisata</a></li>
                <li><a href="daftarpesanan.html">Daftar Paket Wisata</a></li>
                <li><a href="modifikasipesanan.html">Modifikasi Pesanan</a></li>

            </ul>
        </div>
    </header>
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

// Handle delete request
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $delete_sql = "DELETE FROM pesanan WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: modifikasipesanan.php"); // Redirect to the same page
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifikasi Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Daftar Pesanan</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pemesan</th>
                    <th>Nomor HP</th>
                    <th>Tanggal Pesan</th>
                    <th>Pelayanan</th>
                    <th>Jumlah Peserta</th>
                    <th>Waktu Perjalanan</th>
                    <th>Harga Paket</th>
                    <th>Jumlah Tagihan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch and display data
                $sql = "SELECT * FROM pesanan";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["nomor_hp"] . "</td>";
                        echo "<td>" . $row["tanggal_pesan"] . "</td>";
                        echo "<td>" . implode(', ', json_decode($row["paket"], true)) . "</td>";
                        echo "<td>" . $row["jumlah_peserta"] . "</td>";
                        echo "<td>" . $row["waktu_perjalanan"] . "</td>";
                        echo "<td>Rp " . number_format($row["harga_paket"], 0, ',', '.') . "</td>";
                        echo "<td>Rp " . number_format($row["jumlah_tagihan"], 0, ',', '.') . "</td>";
                        echo "<td>
                                <a href='editpesanan.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Ubah</a>
                                <a href='?action=delete&id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus?\")'>Hapus</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>Tidak ada data.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <a href="index.html" class="btn btn-primary">Kembali</a>
    </div>
</body>
</html>

       <!--footer-->
       <footer class="text-white text-center py-4 mt-5" style="background-color: #60bb93;">
        <div class="container">
            <div class="row">
                <div class="row">
                    <small>Contact Us</small>
                    <small>Email: info@example.com</small>
                    <small>Phone: +62 812 3456 7890</small>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <small class="mb-0">&copy; 2024 Jalan-Jalan.com. All Rights Reserved.</small>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
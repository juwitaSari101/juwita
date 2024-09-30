<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempat Pariwisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="wisata.html">Wisata</a></li>
                <li class="active"><a href="daftarpesanan.html">Daftar Paket Wisata</a></li>
                <li><a href="modifikasipesanan.php">Modifikasi Pesanan</a></li>
            </ul>
        </div>
    </header>

    <section class="form">
        <div class="container">
            <h2>Form Pemesanan Paket Wisata</h2>
            <form id="bookingForm" action="simpan.php" method="POST">
                <div class="form-group">
                    <label for="nama">Nama Pemesan:</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="nomor_hp">Nomor HP:</label>
                    <input type="tel" id="nomor_hp" name="nomor_hp" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_pesan">Tanggal Pesan:</label>
                    <input type="date" id="tanggal_pesan" name="tanggal_pesan" required>
                </div>
                <div class="form-cekbox">
                    <label>Pelayanan Paket Perjalanan:</label>
                    <div>
                        <input type="checkbox" id="paket1" name="paket[]" value="1000000">
                        <label for="paket1">Penginapan (Rp 1.000.000)</label>
                    </div>
                    <div>
                        <input type="checkbox" id="paket2" name="paket[]" value="1200000">
                        <label for="paket2">Transportasi (Rp 1.200.000)</label>
                    </div>
                    <div>
                        <input type="checkbox" id="paket3" name="paket[]" value="500000">
                        <label for="paket3">Servis/Makan (Rp 500.000)</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="jumlah_peserta">Jumlah Peserta:</label>
                    <input type="number" id="jumlah_peserta" name="jumlah_peserta" required>
                </div>
                <div class="form-group">
                    <label for="waktu_perjalanan">Waktu Perjalanan (hari):</label>
                    <input type="number" id="waktu_perjalanan" name="waktu_perjalanan" required>
                </div>
                <div class="form-group">
                    <label for="harga_paket">Harga Paket Perjalanan:</label>
                    <input type="text" id="harga_paket" name="harga_paket" readonly>
                </div>
                <div class="form-group">
                    <label for="jumlah_tagihan">Jumlah Tagihan:</label>
                    <input type="text" id="jumlah_tagihan" name="jumlah_tagihan" readonly>
                </div>
                <div class="form-button">
                    <input type="button" value="Hitung" onclick="hitungHandler()" />
                    <input type="submit" value="Simpan" />
                    <input type="reset" value="Reset" onclick="resetHandler()" />
                </div>
            </form>
        </div>
    </section>

    <!--footer-->
    <footer class="text-white text-center py-4 mt-5" style="background-color: #60bb93;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <small>Contact Us</small><br>
                    <small>Email: info@example.com</small><br>
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

    <script>
        function hitungHandler() {
            const waktuPerjalanan = parseFloat(document.getElementById('waktu_perjalanan').value) || 0;
            const jumlahPeserta = parseFloat(document.getElementById('jumlah_peserta').value) || 0;

            let totalHargaPaket = 0;

            if (document.getElementById('paket1').checked) totalHargaPaket += 1000000;
            if (document.getElementById('paket2').checked) totalHargaPaket += 1200000;
            if (document.getElementById('paket3').checked) totalHargaPaket += 500000;

            const hargaPaket = totalHargaPaket;
            const jumlahTagihan = jumlahPeserta * waktuPerjalanan * hargaPaket;

            document.getElementById('harga_paket').value = `Rp ${hargaPaket.toLocaleString()}`;
            document.getElementById('jumlah_tagihan').value = `Rp ${jumlahTagihan.toLocaleString()}`;
        }

        function resetHandler() {
            // Clear input fields but keep the calculation results
            document.getElementById('bookingForm').reset();
            document.getElementById('harga_paket').value = '';
            document.getElementById('jumlah_tagihan').value = '';
        }
    </script>
</body>
</html>

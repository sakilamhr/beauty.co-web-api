<?php
session_start();
include "koneksi.php";

// Ambil data dari form
$kdskincare = $_POST['produk'];
$jumlah = $_POST['jumlah'];
$kdvoucher = $_POST['voucher'];
$metode = $_POST['metode'];
$no_rekening = $_POST['no_rekening'];


// Ambil data produk
$tampil = mysqli_query($koneksi, "SELECT * FROM tb_produk WHERE kd_skincare = '$kdskincare'");
$d = mysqli_fetch_array($tampil);
$hargabarang = $d['harga'];
$merek_barang = $d['merek'];  // Ambil merek dari produk

// Periksa voucher
$voucher_query = mysqli_query($koneksi, "SELECT * FROM tb_voucher WHERE kd_voucher = '$kdvoucher'");
if ($voucher_data = mysqli_fetch_array($voucher_query)) {
    $nilai_voucher = $voucher_data['jml_voucher'];
} else {
    $nilai_voucher = 0; // Jika voucher tidak ditemukan, set nilai voucher ke 0
}

// Hitung total harga
$total = ((int)$hargabarang * (int)$jumlah) - (int)$nilai_voucher;

// Tampil data pengguna
$tampil2 = mysqli_query($koneksi, "SELECT * FROM tb_data JOIN tb_kota ON tb_data.kodepos = tb_kota.kodepos 
                            WHERE username = '" . $_SESSION['username'] . "'");
$a = mysqli_fetch_array($tampil2);

// Ambil metode pembayaran
$metode_query = mysqli_query($koneksi, "SELECT * FROM tb_pay WHERE id_pay = '$metode'");
$m = mysqli_fetch_array($metode_query);
$metode_pembayaran = $m['metode'];  // Ambil metode pembayaran
?>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css/styleprofile.css">
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <a class="navbar-brand fw-bold fs-4 me-auto" href="homepage.php">Beauty.Co</a>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link fs-5" aria-current="page" href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="produkpage.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold fs-5" href="buypage.php">Beli</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="aboutpage.php">Profil</a>
                    </li>
                </ul>
                <a class="btn btn-warning fs-8 m-2" href="logout.php"
                    onclick="return confirm('Yakin Anda Logout?')">LogOut</a>
            </div>
        </div>
    </nav>
    <!-- NAVBAR -->

    <div class="container mt-5">
        <!-- FORM -->
        <div class="card">
            <div class="card-header bg-dark text-white">Form Konfirmasi</div>
            <div class="card-body">
                <form action="actbeli.php" method="post">
                    <h2 class="text-center"><strong>Konfirmasi Pembayaran</strong></h2>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" required="" placeholder="Fullname"
                                    value="<?php echo $a['nama_lengkap'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" required=""
                                    placeholder="Username" value="<?php echo $a['username'] ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat" required="" placeholder="Address"
                                    value="<?php echo $a['alamat'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kode Pos</label>
                                <input type="text" class="form-control" name="kodepos" required="" placeholder="PosCode"
                                    value="<?php echo $a['kodepos'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kota</label>
                                <input type="text" class="form-control" name="kota" required="" placeholder="City"
                                    value="<?php echo $a['kota'] ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <br>
                    <h3><strong>Produk :</strong></h3>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Skincare</label>
                                <input type="text" class="form-control" name="merek" required=""
                                    placeholder="Nama Skincare" value="<?php echo $merek_barang ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" required=""
                                    placeholder="Jumlah Skincare" value="<?= $jumlah ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kode Voucher</label>
                                <input type="text" class="form-control" name="kdvoucher" required=""
                                    placeholder="Kode Voucher" value="<?= $kdvoucher ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Metode Pembayaran</label>
                                <input type="text" class="form-control" name="metode_pembayaran" required=""
                                    placeholder="Metode Pembayaran" value="<?= $metode_pembayaran ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">No Rekening</label>
                                <input type="text" class="form-control" name="no_rekening" required=""
                                    placeholder="Metode Pembayaran" value="<?= $no_rekening ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Add hidden fields for kdskincare and metode -->
                    <input type="hidden" name="kdskincare" value="<?php echo $kdskincare; ?>">
                    <input type="hidden" name="metode" value="<?php echo $metode; ?>">

                    <br>
                    <h3><strong>Total Harga :</strong></h3>
                    <div class="row">
                        <div class="col-md-9">
                            <input type="hidden" class="form-control" name="total" required="" placeholder="Total Harga"
                                value="<?= $total ?>" readonly>
                            <h1 class="text-danger" name="ttl"><strong>Rp.
                                    <?= number_format($total, 0, ',', '.') ?></strong></h1>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-6 d-grid">
                            <button type="submit" class="btn btn-danger">Beli</button>
                        </div>
                        <div class="col-md-6 d-grid">
                            <a href="buypage.php" class="btn btn-warning">Kembali<a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- FORM -->

        <!-- TABEL -->
        <div class="card mt-5">
            <div class="card-header bg-dark text-center text-white fs-16">
                Riwayat Pembelian
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No Order</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Size</th>
                        <th>Alamat</th>
                        <th>Jumlah</th>
                        <th>Voucher</th>
                        <th>Metode Pembayaran</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    $tampil = mysqli_query($koneksi, "SELECT a.no_order, b.nama_lengkap, a.tgl_pesan, 
                                                        c.merek, c.harga, c.ukuran, d.alamat, a.jumlah, e.jml_voucher, 
                                                        f.metode, a.total_harga, a.status 
                                                        FROM tb_order a JOIN tb_data b
                                                        ON a.username=b.username
                                                        JOIN tb_produk c ON a.kd_skincare=c.kd_skincare
                                                        JOIN tb_kota d ON a.kodepos=d.kodepos
                                                        JOIN tb_voucher e ON a.kd_voucher=e.kd_voucher
                                                        JOIN tb_pay f ON a.metode_pembayaran=f.id_pay");
                    while ($data = mysqli_fetch_array($tampil)) :

                    ?>
                        <tr>
                            <td><?= $data['no_order'] ?></td>
                            <td><?= $data['nama_lengkap'] ?></td>
                            <td><?= $data['tgl_pesan'] ?></td>
                            <td><?= $data['merek'] ?></td>
                            <td><?= $data['harga'] ?></td>
                            <td><?= $data['ukuran'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td><?= $data['jumlah'] ?></td>
                            <td><?= $data['jml_voucher'] ?></td>
                            <td><?= $data['metode'] ?></td>
                            <td><?= $data['total_harga'] ?></td>
                            <td><?= $data['status'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
        <!-- TABEL -->
    </div>
    <br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
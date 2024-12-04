<?php
include "../koneksi.php";
include "../api_bank.php";

if (isset($_GET['hal'])) {
    //Pengujian jika approve
    if ($_GET['hal'] == "approve") {
        $edit = $koneksi->query("UPDATE tb_order SET status = 'Approve' WHERE no_order = '$_GET[id]'");

        if ($edit == true) {
            echo "<script>alert('Order Akan Di Proses');
                window.location.href=('approval.php');</script>";
            // PostTransaction();
        } else {
            echo "<script>alert('Order GAGAL Di Proses');
            window.location.href=('approval.php');</script>";
        }
    } else if ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($koneksi, "DELETE FROM tb_order WHERE no_order = '$_GET[id]'");

        if ($hapus) {
            echo "<script>alert('Hapus Data SUKSES');
                window.location.href=('approval.php');</script>";
        }
    }
}

?>


<html>

<head>
    <title>Approval</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="stylesheet" href="../css/css/style.css">
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navi">
        <div class="container">
            <a class="navbar-brand" href="#">
                <a class="navbar-brand fw-bold fs-4 me-auto" href="../adminpage.php">Hello Admin</a>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li>
                        <div class="dropdown ">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Pengaturan Utama
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="pemasok.php">Pemasok</a></li>
                                <li><a class="dropdown-item" href="voucher.php">Voucher</a></li>
                                <li><a class="dropdown-item" href="kategori.php">Kategori</a></li>
                                <li><a class="dropdown-item" href="pay.php">Metode Pembayaran</a></li>

                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown ">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Transaksi Relasi
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><a class="dropdown-item" href="restock.php">Restock</a></li>
                                <li><a class="dropdown-item" href="produk.php">Produk</a></li>
                                <li><a class="dropdown-item" href="approval.php">Approval</a></li>
                                <li><a class="dropdown-item" href="akun.php">Edit Pengguna</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>


            <a class="btn btn-light btn-outline-dark fs-8m-2" href="../logout.php"
                onclick="return confirm('Yakin Anda Logout?')">LogOut</a>
        </div>
    </nav>
    <!-- NAVBAR -->

    <div class="container">
        <h3 class="text-center fw-bold m-5"> Approval </h3>


        <div class="container-fluid mt-5">
            <!-- Tabel Pembelian Belum Approve -->
            <div class="card mt-3">
                <div class="card-header bg-dark text-center text-white fs-6">
                    Pembelian Belum Approve
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <td scope="col">No Order</td>
                                    <td scope="col">Nama</td>
                                    <td scope="col">Tanggal</td>
                                    <td scope="col">Produk</td>
                                    <td scope="col">Harga</td>
                                    <td scope="col">Size</td>
                                    <td scope="col">Alamat</td>
                                    <td scope="col">Jumlah</td>
                                    <td scope="col">Voucher</td>
                                    <td scope="col">Metode Pembayaran</td>
                                    <td scope="col">Total Harga</td>
                                    <td scope="col">Status</td>
                                    <td scope="col">Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "../koneksi.php";
                                $tampil = mysqli_query($koneksi, "SELECT a.no_order, b.nama_lengkap, a.tgl_pesan, 
                                                            c.merek, c.harga, c.ukuran, d.alamat, a.jumlah, e.jml_voucher, 
                                                            f.metode, a.total_harga, a.status 
                                                            FROM tb_order a JOIN tb_data b
                                                            ON a.username=b.username
                                                            JOIN tb_produk c ON a.kd_skincare=c.kd_skincare
                                                            JOIN tb_kota d ON a.kodepos=d.kodepos
                                                            JOIN tb_voucher e ON a.kd_voucher=e.kd_voucher
                                                            JOIN tb_pay f ON a.metode_pembayaran=f.id_pay
                                                            WHERE status='pending'");
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
                                        <td>
                                            <a href="approval.php?hal=approve&id=<?= $data['no_order'] ?>"
                                                onclick="return confirm('Pembelian Akan Di Proses')"
                                                class="btn btn-success btn-sm">Approve</a>
                                            <a href="approval.php?hal=hapus&id=<?= $data['no_order'] ?>"
                                                onclick="return confirm('Yakin Tabel Ini Dihapus?')"
                                                class="btn btn-danger btn-sm">Drop</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Tabel Pembelian Belum Approve -->

            <!-- Tabel Riwayat Pembelian -->
            <div class="card mt-5">
                <div class="card-header bg-dark text-center text-white fs-6">
                    Riwayat Pembelian
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <td scope="col">No Order</td>
                                    <td scope="col">Nama</td>
                                    <td scope="col">Tanggal</td>
                                    <td scope="col">Produk</td>
                                    <td scope="col">Harga</td>
                                    <td scope="col">Size</td>
                                    <td scope="col">Alamat</td>
                                    <td scope="col">Jumlah</td>
                                    <td scope="col">Voucher</td>
                                    <td scope="col">Metode Pembayaran</td>
                                    <td scope="col">Total Harga</td>
                                    <td scope="col">Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tampil = mysqli_query($koneksi, "SELECT a.no_order, b.nama_lengkap, a.tgl_pesan, 
                                                            c.merek, c.harga, c.ukuran, d.alamat, a.jumlah, e.jml_voucher, 
                                                            f.metode, a.total_harga, a.status 
                                                            FROM tb_order a JOIN tb_data b
                                                            ON a.username=b.username
                                                            JOIN tb_produk c ON a.kd_skincare=c.kd_skincare
                                                            JOIN tb_kota d ON a.kodepos=d.kodepos
                                                            JOIN tb_voucher e ON a.kd_voucher=e.kd_voucher
                                                            JOIN tb_pay f ON a.metode_pembayaran=f.id_pay
                                                            WHERE status='Approve'");
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Tabel Riwayat Pembelian -->
        </div>

        <br>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
</body>

</html>
<?php
include "koneksi.php";
?>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css/styleinter.css">
    <title>Moisturizer</title>
</head>

<body style="background-color: #FEE4E9
;">
    <!-- NAVBAR -->
    <?php

    include "navbar.php";
    ?>
    <!-- Akhir NAVBAR -->

    <!-- Card Produk -->
    <div class="container mt-5">
        <div class="row text-center row-judul">
            <h5 class="judul"><strong>Moisturizer</strong></h5>
        </div>
    </div>

    <div class="container mt-6">
        <div class="row">
            <?php
            $tampil = mysqli_query($koneksi, "SELECT p.*, k.kategori FROM tb_produk p JOIN tb_kategori k ON p.kategori = k.id_kategori WHERE k.id_kategori = 'k3'");
            while ($data = mysqli_fetch_array($tampil)) :
            ?>
            <div class="col-lg-3 col-md-2 col-sm-4 col-4 mt-3">
                <div class="card text-center shadow-none border border-dark border-2">
                    <div class="card-header">
                        <img src="admin/<?= $data['image'] ?>" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h6 class="card-title fw-bold"><?= $data['merek'] ?></h6>
                        <h6>size <?= $data['ukuran'] ?></h6>
                        <p class="card-text">Rp. <?= $data['harga'] ?></p>
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a type="button" class="btn btn-outline-dark d-grid" data-bs-toggle="modal"
                            data-bs-target="#detailModal<?= $data['kd_skincare'] ?>">DETAIL</a>
                        <a href="buypage.php?id=<?php echo $data['kd_skincare'] ?>"
                            class="btn btn-outline-dark btn-sm">BELI</a>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="detailModal<?= $data['kd_skincare'] ?>" tabindex="-1"
                aria-labelledby="detailModalLabel<?= $data['kd_skincare'] ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailModalLabel<?= $data['kd_skincare'] ?>">Detail Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="admin/<?= $data['image'] ?>" class="img-fluid mb-3" alt="<?= $data['merek'] ?>">
                            <h5><?= $data['merek'] ?></h5>
                            <p>Kategori: <?= $data['kategori'] ?></p>
                            <p>Ukuran: <?= $data['ukuran'] ?></p>
                            <p>Varian: <?= $data['varian'] ?></p>
                            <p>Harga: Rp. <?= $data['harga'] ?></p>
                            <p>Stok: <?= $data['stok'] ?></p>
                            <p>Deskripsi: <?= $data['deskripsi'] ?></p>
                        </div>
                        <div class="modal-footer">
                            <a href="buypage.php?id=<?= $data['kd_skincare'] ?>" class="btn btn-outline-dark">Beli
                                Sekarang</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- TABEL -->
    <div class="container mt-5">
        <div class="card mt-3">
            <div class="card-header bg-dark text-center text-white fs-16">
                Daftar Moisturizer
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Kode Skincare</th>
                        <th>Kategori</th>
                        <th>Merk</th>
                        <th>Ukuran</th>
                        <th>Varian</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                    <?php
                    $tampil = mysqli_query($koneksi, "SELECT p.*, k.kategori FROM tb_produk p JOIN tb_kategori k ON p.kategori = k.id_kategori WHERE k.id_kategori = 'k3'");
                    while ($data = mysqli_fetch_array($tampil)) :
                    ?>
                    <tr>
                        <td><?= $data['kd_skincare'] ?></td>
                        <td><?= $data['kategori'] ?></td>
                        <td><?= $data['merek'] ?></td>
                        <td><?= $data['ukuran'] ?></td>
                        <td><?= $data['varian'] ?></td>
                        <td><?= $data['harga'] ?></td>
                        <td><?= $data['stok'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
    <!-- TABEL -->

    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
session_start();
include "koneksi.php";

// Include file untuk mengakses API
include 'api_bank.php';


if ($_SESSION['username'] != true) {
    echo '<script>window.location="loginpage.php"</script>';
}

$kd_produk = $_GET['id'];

if ($kd_produk == null) {
    echo "<script>
            alert('Maaf, Anda harus memilih produk terlebih dahulu');
            window.history.back();
          </script>";
    exit;
}



$tampil = mysqli_query($koneksi, "SELECT * FROM tb_data JOIN tb_kota ON tb_data.kodepos = tb_kota.kodepos 
                            WHERE username = '" . $_SESSION['username'] . "'");
$d = mysqli_fetch_array($tampil);
?>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css/styleprofile.css">
    <title>Buy Page</title>
</head>

<body>
    <!-- NAVBAR -->
    <?php

    include "navbar.php";
    ?>
    <!-- NAVBAR -->

    <!-- FORM  -->
    <div class="container mt-5">
        <form action="konfirmasi.php" method="POST" class="form-container-fluid">
            <h3><strong>Data Diri :</strong></h3>
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" required="" placeholder="Fullname"
                            value="<?php echo $d['nama_lengkap'] ?>" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required="" placeholder="Username"
                            value="<?php echo $d['username'] ?>" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" required="" placeholder="Address"
                            value="<?php echo $d['alamat'] ?>" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kode Pos</label>
                        <input type="text" class="form-control" name="kdpos" required="" placeholder="PosCode"
                            value="<?php echo $d['kodepos'] ?>" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kota</label>
                        <input type="text" class="form-control" name="kota" required="" placeholder="City"
                            value="<?php echo $d['kota'] ?>" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">No WhatsApp</label>
                        <input type="text" class="form-control" name="nowa" required="" placeholder="WhatsApp"
                            value="<?php echo $d['no_wa'] ?>" disabled>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required="" placeholder="Email"
                            value="<?php echo $d['email']  ?>" disabled>
                    </div>
                </div>
            </div>

            <br>
            <h3><strong>Produk :</strong></h3>
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Skincare</label>
                        <br>
                        <select name="produk" class="form-control">
                            <?php
                            $query = mysqli_query($koneksi, "SELECT kd_skincare, merek FROM tb_produk");
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <option value="<?= $data['kd_skincare'] ?>" <?php if ($kd_produk === $data['kd_skincare']) {
                                                                                echo 'selected';
                                                                            }; ?>><?= $data['merek'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" required=""
                            placeholder="Jumlah Skincare">
                    </div>
                </div>
            </div>

            <br>
            <h3><strong>Payment :</strong></h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kode Voucher</label>
                        <br>
                        <select name="voucher" class="form-control">
                            <?php
                            $query = mysqli_query($koneksi, "SELECT kd_voucher FROM tb_voucher");
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <option value="<?= $data['kd_voucher'] ?>"><?= $data['kd_voucher'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Metode Pembayaran</label>
                        <br>
                        <select id="metode_pembayaran" name="metode" class="form-control">
                            <?php
                            $query = mysqli_query($koneksi, "SELECT id_pay, metode FROM tb_pay");
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <option value="<?= $data['id_pay'] ?>"><?= $data['metode'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- INPUTAN NO REKENING -->
                <div class="col-md-5" id="rekening_section" style="display: none;">
                    <div class="mb-3 d-flex flex-row ">
                        <label for="no_rekening" class="form-label">Nomor Rekening</label>
                        <input type="text" class="form-control" name="no_rekening" id="no_rekening"
                            placeholder="Masukkan Nomor Rekening">
                        <button type="button" id="check_rekening" class="btn btn-primary mt-2 mx-4">Check</button>
                    </div>
                </div>



                <div class="row mt-4">
                    <div class="col-md-12 d-grid">
                        <button type="submit" class="btn btn-outline-dark" id="btn-beli">Beli</button>
                    </div>
                </div>
        </form>
    </div>
    <!-- FORM  -->

    <!-- popup -->
    <div id="popup"
        style="z-index: 20; display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 8px; text-align: center;">
            <p id="popup_message"></p>
            <button onclick="closePopup()" class="btn btn-secondary">Close</button>
        </div>
    </div>

    <!-- TABEL -->
    <div class="container-fluid mt-5" style="z-index: 0;">
        <div class="card mt-3">
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
                    include "koneksi.php";
                    $nama = $_SESSION['username'];

                    $tampil2 = mysqli_query($koneksi, "SELECT a.no_order, b.nama_lengkap, a.tgl_pesan, 
                                                    c.merek, c.harga, c.ukuran, d.alamat, a.jumlah, e.jml_voucher, 
                                                    f.metode, a.total_harga, a.status 
                                                    FROM tb_order a JOIN tb_data b
                                                    ON a.username=b.username
                                                    JOIN tb_produk c ON a.kd_skincare=c.kd_skincare
                                                    JOIN tb_kota d ON a.kodepos=d.kodepos
                                                    JOIN tb_voucher e ON a.kd_voucher=e.kd_voucher
                                                    JOIN tb_pay f ON a.metode_pembayaran=f.id_pay 
                                                    WHERE a.username = '$nama'");
                    while ($data = mysqli_fetch_array($tampil2)) :
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
    </div>
    <!-- TABEL -->

    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


    <script>
    // Jika input Kipay maka memunculkan inputan no rekening
    document.getElementById('metode_pembayaran').addEventListener('change', function() {
        var id_pay = this.value;
        var btnBeli = document.getElementById("btn-beli");
        var rekeningSection = document.getElementById('rekening_section');

        // Cek apakah metode yang dipilih adalah "KiPay"
        if (id_pay === 'e5') {
            btnBeli.disabled = true;
            rekeningSection.style.display = 'block'; // Tampilkan input nomor rekening
        } else {
            btnBeli.disabled = false;
            rekeningSection.style.display = 'none'; // Sembunyikan jika bukan KiPay
        }
    });


    // Function to open the popup
    function openPopup(message) {
        document.getElementById('popup_message').textContent = message;
        document.getElementById('popup').style.display = 'flex';
    }

    // Function to close the popup
    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }


    // Event listener for the check button
    document.getElementById('check_rekening').addEventListener('click', function() {
        var btnBeli = document.getElementById("btn-beli");
        var noRekening = document.getElementById('no_rekening').value;

        if (noRekening === "") {
            openPopup("Nomor rekening harus diisi.");
            return;
        }

        var link = "http://bank-server.test/api/rekening/" + noRekening + "?apiKey=qwged76jkxndcshjvjasv";

        // Kirim request ke API untuk memeriksa nomor rekening
        fetch(link, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                console.log(data['data']['no_rekening']);


                if (data['data']['no_rekening']) {

                    openPopup("Nomor rekening valid! Atas Nama " + data['data']['nasabah']['nama_lengkap']);
                    btnBeli.disabled = false;
                } else {
                    openPopup("Nomor rekening tidak ditemukan.");
                }
            })
            .catch(error => {
                openPopup("Terjadi kesalahan saat memeriksa nomor rekening.");
                console.error('Error:', error);
            });
    });
    </script>
</body>

</html>
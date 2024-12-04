<?php 
include "../koneksi.php";

if(isset($_POST['simpan'])){
    if($_GET['hal'] == "edit") {
        //data di edit
        $edit = $koneksi -> query("UPDATE tb_voucher SET kd_voucher = '$_POST[kdvoucher]', jml_voucher = '$_POST[jumlah]', 
                                masa_berlaku = '$_POST[masa]' WHERE kd_voucher = '$_GET[id]'");
        if ($edit == true){
            echo "<script>alert('Edit SUKSES'); window.location.href=('voucher.php');</script>";
        } else {
            echo "<script>alert('Edit GAGAL'); window.location.href=('voucher.php');</script>";
        }
    } else {
        //data disimpan baru
        $insert = $koneksi -> query("INSERT INTO `tb_voucher` (kd_voucher, jml_voucher, masa_berlaku) 
                                        VALUES ('$_POST[kdvoucher]', '$_POST[jumlah]', '$_POST[masa]');");
        if ($insert == true){
            echo "<script>alert('Input SUKSES'); window.location.href=('voucher.php');</script>";
        } else {
            echo "<script>alert('Input GAGAL'); window.location.href=('voucher.php');</script>";
        }
    }
}

if(isset($_GET['hal'])) {
    //Pengujian jika edit
    if($_GET['hal'] == "edit") {
        $tampil = mysqli_query($koneksi, "SELECT * FROM tb_voucher WHERE kd_voucher='$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if($data) {
            $id = $data['kd_voucher'];
            $jumlah = $data['jml_voucher'];
            $masa = $data['masa_berlaku'];
        }
    } elseif ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($koneksi, "DELETE FROM tb_voucher WHERE kd_voucher = '$_GET[id]'");
        if($hapus) {
            echo "<script>alert('Hapus Data SUKSES'); window.location.href=('voucher.php');</script>";
        }
    }
}

if(isset($_POST['delete_selected'])) {
    if(isset($_POST['selected_items']) && is_array($_POST['selected_items'])) {
        // Nonaktifkan constraint foreign key sementara
        mysqli_query($koneksi, "SET foreign_key_checks = 0");

        foreach($_POST['selected_items'] as $selected) {
            // Lakukan penghapusan untuk setiap item yang dipilih
            $delete = mysqli_query($koneksi, "DELETE FROM tb_voucher WHERE kd_voucher = '$selected'");
            // Tambahkan logika penanganan kesalahan jika diperlukan
        }
        
        // Aktifkan kembali constraint foreign key
        mysqli_query($koneksi, "SET foreign_key_checks = 1");

        echo "<script>alert('Hapus Data SUKSES');</script>";
        echo "<script>window.location.href=('voucher.php');</script>";
    }
}
?>

<html>
<head>
    <title>Pemasok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/css/style.css">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navi">
        <div class="container">
            <a class="navbar-brand" href="#">
                <a class="navbar-brand fw-bold fs-4 me-auto" href="../adminpage.php">Hello Admin</a>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li>
                        <div class="dropdown ">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">Pengaturan Utama</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="pemasok.php">Pemasok</a></li>
                                <li><a class="dropdown-item" href="voucher.php" >Voucher</a></li>
                                <li><a class="dropdown-item" href="kategori.php" >Kategori</a></li>
                                <li><a class="dropdown-item" href="pay.php">Metode Pembayaran</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown ">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">Transaksi Relasi</button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <li><a class="dropdown-item" href="restock.php">Restock</a></li>
                                <li><a class="dropdown-item" href="produk.php">Produk</a></li>
                                <li><a class="dropdown-item" href="approval.php" >Approval</a></li>
                                <li><a class="dropdown-item" href="akun.php">Edit Pengguna</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <a class="btn btn-light btn-outline-dark fs-8m-2" href="../logout.php" onclick="return confirm('Yakin Anda Logout?')">LogOut</a>
        </div>
    </nav>
    <!-- NAVBAR -->
    
    <div class="container">
        <h3 class="text-center fw-bold m-5"> Voucher </h3>
        <!-- FORM -->
        <div class="card mt-3">
            <div class="card-header bg-dark text-white ">
                Form Voucher
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kode Voucher</label>
                                <input type="text" class="form-control" name="kdvoucher" required="" placeholder="kode voucher" value="<?=@$id?>">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Jumlah Voucher</label>
                                <input type="text" class="form-control" name="jumlah" required="" placeholder="jumlah voucher" value="<?=@$jumlah?>">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Masa Berlaku Voucher</label>
                                <input type="text" class="form-control" name="masa" required="" placeholder="masa berlaku" value="<?=@$masa?>">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                                <button type="reset" class="btn btn-danger">Hapus</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- FORM -->

        <!-- Tabel -->
        <form action="" method="POST">
            
                        <div class="card mt-3">
                <div class="card-header bg-dark text-white">
                    Tabel Voucher
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th></th> <!-- Kolom untuk checkbox -->
                            <th>Kode Voucher</th>
                            <th>Jumlah Voucher</th>
                            <th>Masa Berlaku</th>
                            <th>Aksi</th>
                        </tr>
                        <?php 
                        $tampil = mysqli_query($koneksi, "SELECT * FROM tb_voucher");
                        while($data = mysqli_fetch_array($tampil)) :
                        ?>
                        <tr>
                            <td><input type="checkbox" name="selected_items[]" value="<?=$data['kd_voucher']?>"></td>
                            <td><?=$data['kd_voucher']?></td>
                            <td><?=$data['jml_voucher']?></td>
                            <td><?=$data['masa_berlaku']?></td>
                            <td>
                                <a href="voucher.php?hal=edit&id=<?=$data['kd_voucher']?>" class="btn btn-outline-dark"> Edit </a>
                                <!-- <a href="voucher.php?hal=hapus&id=<?=$data['kd_voucher']?>" 
                                onclick="return confirm('Yakin Tabel Ini Dihapus?')" class="btn btn-danger"> Drop </a> -->
                            </td>
                        </tr>

                        <?php endwhile; ?>
                        <div class="mb-3">
                    </table>
                    <button type="submit" class="btn btn-danger" name="delete_selected">Delete Selected</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- Tabel -->
    </div>
    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

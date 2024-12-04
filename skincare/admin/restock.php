<?php 
include "../koneksi.php";



if(isset($_POST['simpan'])){

    if($_GET['hal'] == "edit")
    {

    //data di edit
        $edit = $koneksi -> query("UPDATE tb_restok SET kd_skincare = '$_POST[kd_skincare]', jumlah = '$_POST[jumlah]', 
                                nama_supplier = '$_POST[supplier]' WHERE kd_pembelian = '$_GET[id]'");

        if ($edit == true){
            echo "<script>alert('Edit SUKSES');
                window.location.href=('restock.php');</script>";
        }else{
        echo "<script>alert('Edit GAGAL');
            window.location.href=('restock.php');</script>";
        }

    }else{

    //data disimpan baru
        $insert = $koneksi -> query("INSERT INTO `tb_restok` (kd_skincare, jumlah, nama_supplier) 
                                        VALUES ('$_POST[kdskincare]', '$_POST[jumlah]', '$_POST[supplier]');");

        if ($insert == true){
            echo "<script>alert('Input SUKSES');
                window.location.href=('restock.php');</script>";
        }else{
        echo "<script>alert('Input GAGAL');
            window.location.href=('restock.php');</script>";
        }
    }
}

if(isset($_GET['hal']))
{
    //Pengujian jika edit
    if($_GET['hal'] == "edit")
    {
        $tampil = mysqli_query($koneksi, "SELECT * FROM tb_restok WHERE kd_pembelian='$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if($data)
        {
            $kdskincare = $data['kd_skincare'];
            $jumlah = $data['jumlah'];
            $supplier = $data['nama_supplier'];
        }
    }else if($_GET['hal'] == "hapus"){
        $hapus = mysqli_query($koneksi, "DELETE FROM tb_restok WHERE kd_pembelian = '$_GET[id]'");

        if($hapus){
            echo "<script>alert('Hapus Data SUKSES');
                window.location.href=('restock.php');</script>";
        }
    }
}
?>

<html>
    <head>
        <title>Restock</title>

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
                                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pengaturan Utama
                                    </button>
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
                                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                        Transaksi Relasi
                                    </button>
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

        <div class="container mt-5">
            <h3 class="text-center"><strong>Restock Skincare</strong></h3>
            <!-- FORM -->
            <div class="card mt-5">
                    <div class="card-header bg-dark text-white ">
                        Form Restock
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Kode Skincare</label>
                                            <select name="kdskincare" class="form-control">
                                            <?php 
                                            $query = mysqli_query($koneksi, "SELECT * FROM tb_produk");
                                            while ($data=mysqli_fetch_array($query)){
                                            ?>
                                                <option value="<?=$data['kd_skincare']?>"><?=$data['kd_skincare']?></option>
                                            <?php
                                            }
                                            ?>
                                            </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Jumlah Restok</label>
                                        <input type="text" class="form-control" name="jumlah" required="" placeholder="jumlah Restock" value="<?=@$jumlah?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Supplier</label>
                                        <select name="supplier" class="form-control">
                                            <?php 
                                            $query = mysqli_query($koneksi, "SELECT * FROM tb_pemasok");
                                            while ($data=mysqli_fetch_array($query)){
                                            ?>
                                                <option value="<?=$data['id_pemasok']?>"><?=$data['id_pemasok']?> - <?=$data['nama_supplier']?></option>
                                            <?php
                                            }
                                            ?>
                                            </select>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                                        <button type="reset" class="btn btn-danger" >Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <!-- FORM -->

            <!-- TABEL -->
            <div class="card mt-4">
                <div class="card-header bg-dark text-white">Riwayat Restock</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>id pembelian</th>
                            <th>Kode Skincare</th>
                            <th>Jumlah</th>
                            <th>Supplier</th>
                            <th>Aksi</th>
                        </tr>
                        <?php 
                        include "../koneksi.php";

                        $tampil = mysqli_query($koneksi, "SELECT * FROM tb_restok");
                        while($data=mysqli_fetch_array($tampil)) :

                        ?>
                        <tr>
                            <td><?=$data['kd_pembelian']?></td>
                            <td><?=$data['kd_skincare'] ?></td>
                            <td><?=$data['jumlah'] ?></td>
                            <td><?=$data['nama_supplier'] ?></td>
                            <td>
                                <a href="restock.php?hal=edit&id=<?=$data['kd_pembelian']?>" class="btn btn-outline-dark"> Edit </a>
                                <a href="restock.php?hal=hapus&id=<?=$data['kd_pembelian']?>" 
                                onclick="return confirm('Yakin Tabel Ini Dihapus?')" class="btn btn-outline-dark"> Drop </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
            </div>
            <!-- TABEL -->

            <!-- Tabel Skincare-->
            <div class="card mt-3">
                <div class="card-header bg-dark text-white">
                    Tabel Produk
                </div>
                <div class="card-body">
                    <table class="table table-striped" >
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
                        include "../koneksi.php";
                        
                        $tampil = mysqli_query($koneksi, "SELECT * FROM tb_produk");
                        while($data=mysqli_fetch_array($tampil)) :
                        
                        
                        ?>
                        <tr>
                            <td><?=$data['kd_skincare']?></td>
                            <td><?=$data['kategori']?></td>
                            <td><?=$data['merek']?></td>
                            <td><?=$data['ukuran']?></td>
                            <td><?=$data['varian']?></td>
                            <td><?=$data['harga']?></td>
                            <td><?=$data['stok']?></td>
                        </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
            </div>
            <!-- Tabel Skincare -->

        </div>


        
        
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>

</html>
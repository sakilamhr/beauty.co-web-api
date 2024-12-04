<?php 
include "../koneksi.php";


if(isset($_POST['simpan'])){

    if($_GET['hal'] == "edit")
    {

    //data di edit
        $edit = $koneksi -> query("UPDATE tb_pay SET id_pay = '$_POST[idpay]', metode = '$_POST[metode]' 
                                WHERE id_pay = '$_GET[id]'");

        if ($edit == true){
            echo "<script>alert('Edit SUKSES');
                window.location.href=('pay.php');</script>";
        }else{
        echo "<script>alert('Edit GAGAL');
            window.location.href=('pay.php');</script>";
        }

    }else{

    //data disimpan baru
        $insert = $koneksi -> query("INSERT INTO `tb_pay` (id_pay, metode) VALUES ('$_POST[idpay]', '$_POST[metode]');");

        if ($insert == true){
            echo "<script>alert('Input SUKSES');
                window.location.href=('pay.php');</script>";
        }else{
        echo "<script>alert('Input GAGAL');
            window.location.href=('pay.php');</script>";
        }
    }


    
}

if(isset($_GET['hal']))
{
    //Pengujian jika edit
    if($_GET['hal'] == "edit")
    {
        $tampil = mysqli_query($koneksi, "SELECT * FROM tb_pay WHERE id_pay='$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if($data)
        {
            $id = $data['id_pay'];
            $metode = $data['metode'];
        }
    }else if($_GET['hal'] == "hapus"){
        $hapus = mysqli_query($koneksi, "DELETE FROM tb_pay WHERE id_pay = '$_GET[id]'");

        if($hapus){
            echo "<script>alert('Hapus Data SUKSES');
                window.location.href=('pay.php');</script>";
        }
    }
}
?>



<html>
    <head>
        <title>Kategori</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        

        <link rel="stylesheet" href="../css/css/style.css">
    </head>
    <body>
        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark navi">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <!-- <img src="../img/LOGO.png" width="35" height="40" class="me"> -->
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

        <div class="container">
            <h3 class="text-center fw-bold m-5"> Pengaturan Payment </h3>

            <!-- FORM -->
            <div class="card">
                <div class="card-header bg-dark text-white ">
                    Form Pengaturan Payment
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Id_pay</label>
                                    <input type="text" class="form-control" name="idpay" required="" placeholder="idpay" value="<?=@$id?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Metode</label>
                                    <input type="text" class="form-control" name="metode" required="" placeholder="metode" value="<?=@$metode?>">
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

            <!-- Tabel -->
            <div class="card mt-3">
                <div class="card-header bg-dark text-white">
                    Tabel Payment
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>id Payment</th>
                            <th>Metode Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                        <?php 
                        include "../koneksi.php";
                        $tampil = mysqli_query($koneksi, "SELECT * FROM tb_pay");
                        while($data = mysqli_fetch_array($tampil)) :

                        ?>
                        <tr>
                            <td><?=$data['id_pay']?></td>
                            <td><?=$data['metode']?></td>
                            <td>
                                <a href="pay.php?hal=edit&id=<?=$data['id_pay']?>" class="btn btn-outline-dark"> Edit </a>
                                <a href="pay.php?hal=hapus&id=<?=$data['id_pay']?>" 
                                onclick="return confirm('Yakin Tabel Ini Dihapus?')" class="btn btn-outline-dark"> Drop </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
            </div>
            <!-- Tabel -->

        </div>

    <br>

        
        
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
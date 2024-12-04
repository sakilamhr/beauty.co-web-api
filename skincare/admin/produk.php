<?php 
include "../koneksi.php";


if(isset($_POST['simpan'])){

    if($_GET['hal'] == "edit")
    {

    //data di edit
        $edit = $koneksi -> query("UPDATE tb_produk SET kd_skincare = '$_POST[kdskincare]', kategori = '$_POST[kategori]', 
                                merek = '$_POST[merk]', ukuran = '$_POST[ukuran]', varian = '$_POST[varian]', harga = '$_POST[harga]',
                                stok = '$_POST[stok]', deskripsi = '$_POST[deskripsi]' WHERE kd_skincare = '$_GET[id]'");

        if ($edit == true){
            echo "<script>alert('Edit SUKSES');
                window.location.href=('produk.php');</script>";
        }else{
        echo "<script>alert('Edit GAGAL');
            window.location.href=('produk.php');</script>";
        }

    }else{
        $target_dir = "uploads/"; 
        $target_file = $target_dir . basename($_FILES["file"]["name"]); 
        $uploadOk = 1; 
        
        if (file_exists($target_file)) {
            echo "Maaf, file tersebut sudah ada.";
            $uploadOk = 0;
        }

        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
            echo "Maaf, hanya file JPG, JPEG, PNG, & GIF yang diizinkan.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
           move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        }
    //data disimpan baru
        $insert = $koneksi -> query("INSERT INTO `tb_produk` (kd_skincare, kategori, merek, ukuran, varian, harga, stok, image, deskripsi) 
                                        VALUES ('$_POST[kdskincare]', '$_POST[kategori]', '$_POST[merk]', '$_POST[ukuran]',
                                        '$_POST[varian]', '$_POST[harga]', '$_POST[stok]','$target_file', '$_POST[deskripsi]');");

        if ($insert == true){
            echo "<script>alert('Input SUKSES');
                window.location.href=('produk.php');</script>";
        }else{
        echo "<script>alert('Input GAGAL');
            window.location.href=('produk.php');</script>";
        }
    }
}

if(isset($_GET['hal']))
{
    //Pengujian jika edit
    if($_GET['hal'] == "edit")
    {
        $tampil = mysqli_query($koneksi, "SELECT * FROM tb_produk WHERE kd_skincare='$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if($data)
        {
            $id = $data['kd_skincare'];
            $kategori = $data['kategori'];
            $merek = $data['merek'];       
            $ukuran = $data['ukuran'];
            $varian = $data['varian'];
            $harga = $data['harga'];
            $stok = $data['stok'];
            $image = $data['image'];
            $deskripsi = $data['deskripsi'];
            
        }
    }else if($_GET['hal'] == "hapus"){
        $hapus = mysqli_query($koneksi, "DELETE FROM tb_produk WHERE kd_skincare = '$_GET[id]'");

        if($hapus){
            echo "<script>alert('Hapus Data SUKSES');
                window.location.href=('produk.php');</script>";
        }
    }
}
?>


<html>
    <head>
        <title>Produk</title>

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

        <div class="container">
        <h3 class="text-center fw-bold m-5"> Produk </h3>
            <!-- FORM -->
            <div class="card mt-3">
                <div class="card-header bg-dark text-white ">
                    Form Produk
                </div>
                <div class="card-body">
                    <form action="" enctype='multipart/form-data' method="POST">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Kode Skincare</label>
                                    <input type="text" class="form-control" name="kdskincare" required="" placeholder="kode skincare" value="<?=@$id?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Kategori</label>
                                    <input type="text" class="form-control" name="kategori" required="" placeholder="kategori" value="<?=@$kategori?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Merk</label>
                                    <input type="text" class="form-control" name="merk" required="" placeholder="merk skincare" value="<?=@$merek?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Ukuran</label>
                                    <input type="text" class="form-control" name="ukuran" required="" placeholder="ukuran" value="<?=@$ukuran?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Varian</label>
                                    <input type="text" class="form-control" name="varian" required="" placeholder="varian skincare" value="<?=@$varian?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Harga</label>
                                    <input type="text" class="form-control" name="harga" required="" placeholder="harga" value="<?=@$harga?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Stok</label>
                                    <input type="text" class="form-control" name="stok" required="" placeholder="Stok Produk" value="<?=@$stok?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Upload Image</label>
                                    <input type="file" class="form-control" name="file"/>
                                </div>
                                <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" required="" placeholder="deskripsi skincare"><?= isset($deskripsi) ? $deskripsi : '' ?></textarea>
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
                            <th>image</th>
                            <th>Deskripsi</th>
                            <td>Aksi</td>
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
                            <td><?=$data['image']?></td>
                            <td><?=$data['deskripsi']?></td>
                            <td>
                                <a href="produk.php?hal=edit&id=<?=$data['kd_skincare']?> " class="btn btn-outline-dark">Edit</a>
                                <a href="produk.php?hal=hapus&id=<?=$data['kd_skincare']?>" onclick="return confirm('Yakin Tabel Ini Dihapus?')" class="btn btn-outline-dark">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
            </div>
            <!-- Tabel -->



    <br>

        
        
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
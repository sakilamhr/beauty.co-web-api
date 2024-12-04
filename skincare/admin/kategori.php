<?php 
include "../koneksi.php";

if(isset($_POST['simpan'])){
    if($_GET['hal'] == "edit"){
        //data di edit
        $edit = $koneksi -> query("UPDATE tb_kategori SET id_kategori = '$_POST[idkategori]', kategori = '$_POST[kategori]' 
                                WHERE id_kategori = '$_GET[id]'");

        if ($edit == true){
            echo "<script>alert('Edit SUKSES'); window.location.href=('kategori.php');</script>";
        }else{
            echo "<script>alert('Edit GAGAL'); window.location.href=('kategori.php');</script>";
        }
    }else{
        //data disimpan baru
        $insert = $koneksi -> query("INSERT INTO tb_kategori (id_kategori, kategori) VALUES ('$_POST[idkategori]', '$_POST[kategori]');");

        if ($insert == true){
            echo "<script>alert('Input SUKSES'); window.location.href=('kategori.php');</script>";
        }else{
            echo "<script>alert('Input GAGAL'); window.location.href=('kategori.php');</script>";
        }
    }
}

if(isset($_POST['multi_update'])){
    if(!empty($_POST['update_ids'])){
        foreach($_POST['update_ids'] as $update_id){
            $id_kategori = $_POST['idkategori_' . $update_id];
            $kategori = $_POST['kategori_' . $update_id];
            $update = $koneksi -> query("UPDATE tb_kategori SET id_kategori = '$id_kategori', kategori = '$kategori' WHERE id_kategori = '$update_id'");

            if(!$update){
                echo "<script>alert('Update GAGAL untuk ID: $update_id'); window.location.href=('kategori.php');</script>";
                exit;
            }
        }
        echo "<script>alert('Update SUKSES'); window.location.href=('kategori.php');</script>";
    }
}

if(isset($_GET['hal'])){
    if($_GET['hal'] == "edit"){
        $tampil = mysqli_query($koneksi, "SELECT * FROM tb_kategori WHERE id_kategori='$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if($data){
            $id = $data['id_kategori'];
            $kategori = $data['kategori'];
        }
    }else if($_GET['hal'] == "hapus"){
        $hapus = mysqli_query($koneksi, "DELETE FROM tb_kategori WHERE id_kategori = '$_GET[id]'");

        if($hapus){
            echo "<script>alert('Hapus Data SUKSES'); window.location.href=('kategori.php');</script>";
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
                    <a class="navbar-brand fw-bold fs-4 me-auto" href="../adminpage.php">Hello Admin</a>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li>
                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
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
                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
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
                <a class="btn btn-light btn-outline-dark fs-8m-2" href="../logout.php" onclick="return confirm('Yakin Anda Logout?')">LogOut</a>
            </div>
        </nav>
        <!-- NAVBAR -->

        <div class="container">
            <h3 class="text-center fw-bold m-5"> Kategori </h3>

            <!-- FORM -->
            <div class="card">
                <div class="card-header bg-dark text-white ">
                    Form Kategori
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="idkategori" class="form-label">Id_Kategori</label>
                                    <input type="text" class="form-control" name="idkategori" required="" placeholder="idkategori" value="<?=@$id?>">
                                </div>
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Nama Kategori</label>
                                    <input type="text" class="form-control" name="kategori" required="" placeholder="nama kategori" value="<?=@$kategori?>">
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
            <div class="card mt-3">
                <div class="card-header bg-dark text-white">
                    Tabel Kategori
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <table class="table table-striped">
                            <tr>
                                <th>Select</th>
                                <th>id Kategori</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                            <?php 
                            include "../koneksi.php";
                            $tampil = mysqli_query($koneksi, "SELECT * FROM tb_kategori");
                            while($data = mysqli_fetch_array($tampil)) :
                            ?>
                            <tr>
                                <td><input type="checkbox" name="update_ids[]" value="<?=$data['id_kategori']?>"></td>
                                <td><input type="text" class="form-control" name="idkategori_<?=$data['id_kategori']?>" value="<?=$data['id_kategori']?>"></td>
                                <td><input type="text" class="form-control" name="kategori_<?=$data['id_kategori']?>" value="<?=$data['kategori']?>"></td>
                                <td>
                                    <!-- <a href="kategori.php?hal=edit&id=<?=$data['id_kategori']?>" class="btn btn-warning"> Edit </a> -->
                                    <a href="kategori.php?hal=hapus&id=<?=$data['id_kategori']?>" 
                                    onclick="return confirm('Yakin Tabel Ini Dihapus?')" class="btn btn-outline-dark"> Drop </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </table>
                        <button type="submit" name="multi_update" class="btn btn-success" onclick="return confirm('Yakin Data Ini Diupdate?')">Update Selected</button>
                    </form>
                </div>
            </div>
            <!-- Tabel -->
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
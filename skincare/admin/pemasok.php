<?php 
include "../koneksi.php";

if(isset($_POST['simpan'])){
    if($_GET['hal'] == "edit") {
        //data di edit
        $edit = $koneksi->query("UPDATE tb_pemasok SET id_pemasok = '$_POST[idpemasok]', nama_supplier = '$_POST[supplier]', alamat = '$_POST[alamat]' WHERE id_pemasok = '$_GET[id]'");
        if ($edit == true){
            echo "<script>alert('Edit SUKSES'); window.location.href=('pemasok.php');</script>";
        } else {
            echo "<script>alert('Edit GAGAL'); window.location.href=('pemasok.php');</script>";
        }
    } else {
        //data disimpan baru
        $insert = $koneksi->query("INSERT INTO tb_pemasok (id_pemasok, nama_supplier, alamat) VALUES ('$_POST[idpemasok]', '$_POST[supplier]', '$_POST[alamat]')");
        if ($insert == true){
            echo "<script>alert('Input SUKSES'); window.location.href=('pemasok.php');</script>";
        } else {
            echo "<script>alert('Input GAGAL'); window.location.href=('pemasok.php');</script>";
        }
    }
}

if(isset($_POST['multi_delete'])){
    if(!empty($_POST['delete_ids'])){
        // Sanitize and quote each ID
        $delete_ids = array_map(function($id) use ($koneksi) {
            return "'" . mysqli_real_escape_string($koneksi, $id) . "'";
        }, $_POST['delete_ids']);
        
        // Convert array to comma-separated string
        $delete_ids_str = implode(",", $delete_ids);

        $delete = $koneksi->query("DELETE FROM tb_pemasok WHERE id_pemasok IN ($delete_ids_str)");
        if($delete){
            echo "<script>alert('Hapus Data SUKSES'); window.location.href=('pemasok.php');</script>";
        } else {
            echo "<script>alert('Hapus Data GAGAL'); window.location.href=('pemasok.php');</script>";
        }
    }
}

if(isset($_GET['hal'])){
    if($_GET['hal'] == "edit"){
        $tampil = mysqli_query($koneksi, "SELECT * FROM tb_pemasok WHERE id_pemasok='$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if($data){
            $id = $data['id_pemasok'];
            $supplier = $data['nama_supplier'];
            $alamat = $data['alamat'];
        }
    } else if($_GET['hal'] == "hapus"){
        $hapus = mysqli_query($koneksi, "DELETE FROM tb_pemasok WHERE id_pemasok = '$_GET[id]'");
        if($hapus){
            echo "<script>alert('Hapus Data SUKSES'); window.location.href=('pemasok.php');</script>";
        }
    }
}
?>

<!DOCTYPE html>
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
            <a class="btn btn-light btn-outline-dark fs-8 m-2" href="../logout.php" onclick="return confirm('Yakin Anda Logout?')">LogOut</a>
        </div>
    </nav>
    <!-- NAVBAR -->

    <div class="container">
        <h3 class="text-center fw-bold m-5"> Pemasok </h3>
        <!-- FORM -->
        <div class="card mt-3">
            <div class="card-header bg-dark text-white">
                Form Pemasok
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="idpemasok" class="form-label">Id_Pemasok</label>
                                <input type="text" class="form-control" name="idpemasok" required="" placeholder="id-pemasok" value="<?=@$id?>">
                            </div>
                            <div class="mb-3">
                                <label for="supplier" class="form-label">Nama Supplier</label>
                                <input type="text" class="form-control" name="supplier" required="" placeholder="nama supplier" value="<?=@$supplier?>">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat" required="" placeholder="alamat" value="<?=@$alamat?>">
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
                Tabel Pemasok
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <table class="table table-striped">
                        <tr>
                            <th>Select</th>
                            <th>id Supplier</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                        <?php 
                        $tampil = mysqli_query($koneksi, "SELECT * FROM tb_pemasok");
                        while($data = mysqli_fetch_array($tampil)) :
                        ?>
                        <tr>
                            <td><input type="checkbox" name="delete_ids[]" value="<?=$data['id_pemasok']?>"></td>
                            <td><?=$data['id_pemasok']?></td>
                            <td><?=$data['nama_supplier']?></td>
                            <td><?=$data['alamat']?></td>
                            <td>
                                <a href="pemasok.php?hal=edit&id=<?=$data['id_pemasok']?>" class="btn btn-outline-dark">Edit</a>
                                
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </table>
                    <button type="submit" name="multi_delete" class="btn btn-danger" onclick="return confirm('Yakin Data Ini Dihapus?')">Delete Selected</button>
                </form>
            </div>
        </div>
        <!-- Tabel -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

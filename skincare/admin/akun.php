<?php 
session_start();
include "../koneksi.php";



if(isset($_GET['hal'])){
    $username = $_GET['username'];
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_data WHERE username = '$username'");
    
            if($hapus){
                echo "<script>alert('Hapus Data SUKSES');
                    window.location.href=('akun.php');</script>";
            }
}





if($_SESSION['username'] != true){
    echo '<script>window.location="../loginpage.php"</script>';
}

    $tampil=mysqli_query($koneksi, "SELECT a.username, a.nama_lengkap, a.password, a.no_wa, a.email, 
                                    b.kodepos, c.id_level FROM tb_data a 
                                    JOIN tb_kota b ON a.kodepos=b.kodepos 
                                    JOIN tb_level c ON a.level=c.id_level 
                                    where username='".$_SESSION['username']."'");
    $d = mysqli_fetch_array($tampil);



?>
<html>
    <head>
        <title>Akun</title>

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
            <h3 class="text-center fw-bold m-5"> Atur Akun </h3>
            
            <!-- FORM -->
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Form Data
                </div>
                <div class="card-body">
                    <form action="actakun.php" method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" required="" placeholder="Fullname" value="<?php echo $d['nama_lengkap'] ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" required="" placeholder="Username" value="<?php echo $d['username'] ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="pass" required="" placeholder="Password" value="<?php echo $d['password'] ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Level</label>
                                    <input type="text" class="form-control" name="level" required="" placeholder="Level" value="<?php echo $d['id_level'] ?>">
                                    <div id="emailHelp" class="form-text">1 is Admin, 2 is User</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" required="" placeholder="Username" value="<?php echo $d['email'] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">No WhatsApp</label>
                                    <input type="password" class="form-control" name="nowa" required="" placeholder="Password" value="<?php echo $d['no_wa'] ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Kodepos</label>
                                    <input type="text" class="form-control" name="kodepos" required="" placeholder="Level" value="<?php echo $d['kodepos'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- FORM -->

            <!-- Tabel -->
                <div class="card mt-3">
                    <div class="card-header bg-dark text-white">Tabel Akun Aktif</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>username</th>
                                <th>Password</th>
                                <th>Level</th>
                                <th>Email</th>
                                <th>No Wa</th>
                                <th>KodePos</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            include "../koneksi.php";
                            $tampil = mysqli_query($koneksi, "SELECT * FROM tb_data");
                            while($data = mysqli_fetch_array($tampil)) :
                        
                            ?>
                            <tr>
                                <td><?=$data['nama_lengkap']?></td>
                                <td><?=$data['username']?></td>
                                <td><?=$data['password']?></td>
                                <td><?=$data['level']?></td>
                                <td><?=$data['email']?></td>
                                <td><?=$data['no_wa']?></td>
                                <td><?=$data['kodepos']?></td>
                                <td>
                                    <a href="akun.php?hal=hapus&username=<?=$data['username']?>" onclick="return confirm('Yakin Tabel Ini Dihapus?')" class="btn btn-danger" name="hapus">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?> 
                        </table>
                    </div>
                </div>

        </div>

        <br>
        
        
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>

</html>
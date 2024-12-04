<?php
session_start();
include "koneksi.php";

if ($_SESSION['username'] != true) {
    echo '<script>window.location="loginpage.php"</script>';
}


$tampil = mysqli_query($koneksi, "SELECT a.username, a.nama_lengkap, a.password, a.no_wa, a.email, 
                                    b.kodepos, b.alamat, b.kota,c.id_level FROM tb_data a 
                                    JOIN tb_kota b ON a.kodepos=b.kodepos 
                                    JOIN tb_level c ON a.level=c.id_level 
                                    where username='" . $_SESSION['username'] . "'");
$d = mysqli_fetch_array($tampil);

?>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="css/css/styleprofile.css">

    <title>About Page</title>
</head>

<body>

    <!-- NAVBAR -->
    <?php

    include "navbar.php";
    ?>
    <!-- Navbar -->



    <!-- FORM REGIS -->
    <div class="container mt-5">
        <form action="actprofil.php" method="POST" class="form-container-fluid">
            <h3> <strong>Edit Profil</strong> </h3>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" required="" placeholder="Fullname"
                    value="<?php echo $d['nama_lengkap'] ?>">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required="" placeholder="Username"
                            value="<?php echo $d['username'] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="pass" required="" placeholder="Password"
                            value="<?php echo $d['password'] ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Level</label>
                        <input type="text" class="form-control" name="level" required="" placeholder="Level"
                            value="<?php echo $d['id_level'] ?>">
                        <div id="emailHelp" class="form-text">1 is Admin, 2 is User</div>
                    </div>
                </div>

            </div>

            <br>

            <div class="row">
                <div class="col-md-7">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" required="" placeholder="Address"
                            value="<?php echo $d['alamat'] ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kode Pos</label>
                        <input type="text" class="form-control" name="kodepos" required="" placeholder="PosCode"
                            value="<?php echo $d['kodepos'] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Kota</label>
                        <input type="text" class="form-control" name="kota" required="" placeholder="City"
                            value="<?php echo $d['kota'] ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">No WhatsApp</label>
                        <input type="text" class="form-control" name="nowa" required="" placeholder="WhatsApp"
                            value="<?php echo $d['no_wa'] ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required="" placeholder="Email"
                            value="<?php echo $d['email']  ?>">
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12 d-grid">
                    <button type="submit" class="btn btn-outline-dark">Update</button>
                </div>
            </div>

        </form>


    </div>
    <!-- FORM REGIS -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
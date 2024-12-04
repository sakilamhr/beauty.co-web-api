<?php
include 'koneksi.php'; // Include the connection file

// Fetch levels from the database
$sql = "SELECT id_level, level FROM tb_level";
$result = mysqli_query($koneksi, $sql);

$levels = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $levels[] = $row;
    }
} else {
    echo "No levels found";
}

mysqli_close($koneksi);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleregis.css">
</head>

<body>

    <!-- FORM REGIS -->
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="actregis.php" method="POST" class="form-container">
                            <h3 class="text-center"><strong>Registrasi</strong></h3>
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="fullname" name="nama" required
                                    placeholder="Fullname">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required
                                            placeholder="Username">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="pass" required
                                            placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="level" class="form-label">Level</label>
                                        <select class="form-select" id="level" name="level" required>
                                            <option value="" disabled selected>Pilih Level</option>
                                            <?php foreach ($levels as $level) : ?>
                                                <option value="<?php echo $level['id_level']; ?>">
                                                    <?php echo $level['level']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Alamat</label>
                                        <input type="text" class="form-control" id="address" name="alamat" required
                                            placeholder="Address">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="postalCode" class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" id="postalCode" name="kodepos" required
                                            placeholder="PosCode">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">Kota</label>
                                        <input type="text" class="form-control" id="city" name="kota" required
                                            placeholder="City">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="whatsapp" class="form-label">No WhatsApp</label>
                                        <input type="text" class="form-control" id="whatsapp" name="nowa" required
                                            placeholder="WhatsApp">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required
                                            placeholder="Email">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="termsCheck" required>
                                <label class="form-check-label" for="termsCheck">Saya Menyetujui <strong>Syarat dan
                                        Ketentuan</strong> Yang Berlaku*</label>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6 d-grid">
                                    <button type="submit" class="btn btn-dark">Daftar</button>
                                </div>
                                <div class="col-md-6 d-grid">
                                    <button type="reset" class="btn btn-secondary">Hapus</button>
                                </div>
                            </div>

                            <div class="mt-3 text-center">
                                <label>Sudah Punya Akun? <strong><a href="loginpage.php" class="text-dark">Login
                                            Disini</a></strong></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FORM REGIS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
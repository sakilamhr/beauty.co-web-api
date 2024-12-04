<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Landing page</title>

        <link rel="stylesheet" href="css/css/styleinter.css">
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
                                        <li><a class="dropdown-item" href="admin/pemasok.php">Pemasok</a></li>
                                        <li><a class="dropdown-item" href="admin/voucher.php" >Voucher</a></li>
                                        <li><a class="dropdown-item" href="admin/kategori.php" >Kategori</a></li>
                                        <li><a class="dropdown-item" href="admin/pay.php">Metode Pembayaran</a></li>
                                        
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown ">
                                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                        Transaksi Relasi
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <li><a class="dropdown-item" href="admin/restock.php">Restock</a></li>
                                        <li><a class="dropdown-item" href="admin/produk.php">Produk</a></li>
                                        <li><a class="dropdown-item" href="admin/approval.php" >Approval</a></li>
                                        <li><a class="dropdown-item" href="admin/akun.php">Edit Pengguna</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                

                    <a class="btn btn-light btn-outline-dark fs-8 m-2" href="logout.php" onclick="return confirm('Yakin Anda Logout?')">LogOut</a>
                </div>
        </nav>
        <!-- NAVBAR -->


    <div class="container">
        <!-- CARD -->
        <div class="container mt-5">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100 border-0 shadow">
                        <img src="img/restock.png" class="card-img-top" alt="Restock Produk">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-3">Restock Produk</h5>
                            <!-- <p class="card-text">Menambahkan stok sepatu yang sudah ada.</p> -->
                            <a href="admin/restock.php" class="btn btn-dark">Restock</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 border-0 shadow">
                        <img src="img/add.png" class="card-img-top" alt="Tambah Produk">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-3">Tambah Produk</h5>
                            <!-- <p class="card-text">Menambahkan sepatu baru yang belum ada.</p> -->
                            <a href="admin/produk.php" class="btn btn-dark">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 border-0 shadow">
                        <img src="img/Approval.png" class="card-img-top" alt="Approval">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-3">Approval</h5>
                            <!-- <p class="card-text">Menyetujui pembelian yang dilakukan oleh user.</p> -->
                            <a href="admin/approval.php" class="btn btn-dark">Approve</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD -->
    </div>
 
        <br>

     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
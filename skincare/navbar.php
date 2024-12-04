<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 me-auto" href="homepage.php">Beauty.co</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link fs-5 <?= $current_page == 'homepage.php' || 'tonerpage.php' || 'serumpage.php' || 'moisturizerpage.php' || 'sunscreenpage.php' ? 'active' : '' ?>"
                            href="homepage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 <?= $current_page == 'artikel.php' ? 'active' : '' ?>"
                            href="artikel.php">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 <?= $current_page == 'produkpage.php' ? 'active' : '' ?>"
                            href="produkpage.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 <?= $current_page == 'buypage.php' ? 'active' : '' ?>"
                            href="buypage.php">Beli</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 <?= $current_page == 'aboutpage.php' ? 'active' : '' ?>"
                            href="aboutpage.php">Profil</a>
                    </li>
                </ul>
                <a class="btn btn-danger btn-outline-dark fs-8 m-2 text-white" href="logout.php"
                    onclick="return confirm('Yakin Anda Logout?')">Logout</a>

            </div>
        </div>
    </nav>

</body>

</html>
<style>
.btn-danger.btn-outline-dark:hover {
    background-color: #c82333;
    /* Warna merah yang lebih gelap saat hover */
    border-color: #bd2130;
}
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/stylehome.css">
</head>

<body>

    <!-- NAVBAR -->
    <?php

    include "navbar.php";
    ?>
    <!-- Akhir NAVBAR -->

    <!-- KETERANGAN -->
    <div class="card mt-5 mx-5" style="background-color: #FEE4E9;">
        <div class="card-body">
            <!-- Carousel -->
            <div class="container">
                <div id="carouselExampleIndicators" class="carousel slide mt-3" data-bs-ride="true">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/frame1.jpg" class="d-block img-fluid" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="img/frame2.jpg" class="d-block img-fluid" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <!-- Akhir Carousel -->
            <div class="row text-center mt-3">
                <h4 class="keterangan"><strong>Beauty.co</strong></h4>
                <p class="fs-5">Web Skincare Terlengkap & Terpercaya #1 di Indonesia</p>
            </div>
        </div>
    </div>
    <!-- KETERANGAN -->

    <!-- Kategori -->
    <div class="card text-center my-5 mx-5" style="background-color: #FEE4E9;">
        <div class="card-header bg-dark text-light">
            <h5 class="card-title">Kategori</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Toner</h5>
                            <p class="card-text">Beauty.co menyediakan beragam toner yang dapat membantu meningkatkan
                                kesehatan kulit anda, temukan toner mu sekarang!</p>
                            <a href="tonerpage.php" class="btn btn-dark">Toner</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Serum</h5>
                            <p class="card-text">Beauty.co menyediakan beragam serum yang dapat membantu meningkatkan
                                kesehatan kulit anda, temukan serum mu sekarang!</p>
                            <a href="serumpage.php" class="btn btn-dark">Serum</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Moisturizer</h5>
                            <p class="card-text">Beauty.co menyediakan beragam moisturizer yang dapat membantu
                                meningkatkan kesehatan kulit anda, temukan moisturizer mu sekarang!</p>
                            <a href="moisturizerpage.php" class="btn btn-dark">Moisturizer</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sunscreen</h5>
                            <p class="card-text">Beauty.co menyediakan beragam sunscreen yang dapat membantu
                                meningkatkan kesehatan kulit anda, temukan sunscreen mu sekarang!</p>
                            <a href="sunscreenpage.php" class="btn btn-dark">Sunscreen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir Kategori -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Landing page</title>
    <link rel="stylesheet" href="css/css/style.css">
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <a class="navbar-brand fw-bold fs-4 me-auto" href="index.php">Beauty.co</a>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

            </div>
            <!-- <a class="btn btn-light btn-outline-dark fs-8 m-2" href="logout.php" onclick="return confirm('Yakin Anda Logout?')">Logout</a> -->
        </div>
    </nav>

    <!-- JUMBOTRON -->
    <div class="row p-5">

        <div id="carouselExampleDark" class="carousel carousel-dark slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="img/frame1.jpg" class="d-block w-100">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="card-title fw-bold">Beauty.co</h1>
                        <p>Web Skincare Terlengkap & Terpercaya #1 di Indonesia</p>
                        <a type="button" class="btn btn-outline-dark" href="loginpage.php">Sign IN</a>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="img/frame2.jpg" class="d-block w-100">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="card-title fw-bold">Beauty.co</h1>
                        <p>Web Skincare Terlengkap & Terpercaya #1 di Indonesia</p>
                        <a type="button" class="btn btn-outline-dark" href="loginpage.php">Sign Up</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
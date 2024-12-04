<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap">
</head>
<body style="background-color: #FEE4E9; color: #343a40;">

    <div class="container-fluid d-flex align-items-center justify-content-center" style="height: 100vh;">
        <form action="act_login.php" method="POST" class="form-login p-5 rounded shadow-sm" style="max-width: 500px; background-color: #FFFFFF;">
            <h3 class="text-center mb-4" style="font-family: 'Montserrat', sans-serif; font-weight: 700; color: #343a40;"><strong>Login</strong></h3>
            <div class="mb-3">
                <label for="username" class="form-label" style="color: #343a40;">Username</label>
                <input type="text" class="form-control" id="username" name="username" required placeholder="Username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label" style="color: #343a40;">Password</label>
                <input type="password" class="form-control" id="password" name="pass" required placeholder="Password">
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-dark fw-bold" value="login">Login</button>
            </div>
            <div class="text-center">
                <span style="color: #343a40;">Belum Punya Akun? <a href="regispage.php" class="btn btn-secondary fw-bold">Daftar</a></span>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

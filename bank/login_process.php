<?php
session_start();
include 'koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Menghindari SQL Injection
$email = mysqli_real_escape_string($koneksi, $email);
$password = mysqli_real_escape_string($koneksi, $password);


$query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 1) {

    $user = mysqli_fetch_assoc($result);


    if ($password === $user['password']) {

        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['name'];

        $_SESSION['role'] = $user['role'];


        if ($user['role'] === 'admin') {
            header("Location: dashboard.php");
        } else {
            header("Location: nasabah_dashboard.php");
        }
    } else {

        echo "Password salah!";
    }
} else {

    echo "email tidak ditemukan!";
}

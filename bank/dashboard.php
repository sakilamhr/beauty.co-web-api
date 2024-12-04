<?php
session_start();
include "koneksi.php";
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
$name = $_SESSION['name'];

$sql = "SELECT COUNT(*) as total FROM nasabah";
$result = $koneksi->query($sql);

$sql = "SELECT COUNT(*) as total FROM rekening";
$result_rekening = $koneksi->query($sql);

$sql = "SELECT COUNT(*) as total FROM transaksi";
$result_transaksi = $koneksi->query($sql);


$a = $result->fetch_array();
$b = $result_rekening->fetch_array();
$c = $result_transaksi->fetch_array();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <?php
    include "navbar.php";
    ?>
    <!-- Konten Dashboard -->
    <div class="w-3/4 mx-10 mt-10">
        <h2 class="text-3xl font-bold mb-4 text-indigo-600">Selamat datang, <?php echo $name; ?>!</h2>
        <div class="grid grid-cols-3 gap-4 mt-4">
            <!-- Card 1 -->
            <div class="bg-white p-4 shadow-md rounded-lg">
                <h3 class="text-lg font-bold">Jumlah Nasabah</h3>
                <p class="text-xl font-semibold"><?php echo $a['total'] ?> Nasabah</p>
            </div>
            <!-- Card 2 -->
            <div class="bg-white p-4 shadow-md rounded-lg">
                <h3 class="text-lg font-bold">Jumlah Rekening</h3>
                <p class="text-xl font-semibold"><?= $b['total'] ?> Rekening</p>
            </div>
            <!-- Card 3 -->
            <div class="bg-white p-4 shadow-md rounded-lg">
                <h3 class="text-lg font-bold">Jumlah Transaksi</h3>
                <p class="text-xl font-semibold"><?= $c['total'] ?> Transaksi</p>
            </div>
        </div>
</body>
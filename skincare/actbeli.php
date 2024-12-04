<?php
include "koneksi.php";
include "api_bank.php";

$usn = $_POST['username'];
$kdpos = $_POST['kodepos'];
$kdskincare = $_POST['kdskincare']; // Ensure kdskincare is passed
$jumlah = $_POST['jumlah'];
$kdvoucher = $_POST['kdvoucher'];
$metode = $_POST['metode']; // Ensure metode is passed
$total = $_POST['total'];
$no_rekening = $_POST['no_rekening'];

$status = "pending";

// Check if the metode exists in tb_pay
$metode_query = mysqli_query($koneksi, "SELECT * FROM tb_pay WHERE id_pay = '$metode'");
if (mysqli_num_rows($metode_query) > 0) {
    if ($metode === "e5") {
        $input = $koneksi->query("INSERT INTO `tb_order` (`no_order`, `username`, `tgl_pesan`, `kodepos`, `kd_skincare`, `jumlah`, `kd_voucher`, `metode_pembayaran`, `total_harga`, `status`, `no_rekening`) VALUES (NULL, '$usn', NOW(), '$kdpos', '$kdskincare', '$jumlah', '$kdvoucher', '$metode', '$total', '$status', $no_rekening);");
    } else {
        $input = $koneksi->query("INSERT INTO `tb_order` (`no_order`, `username`, `tgl_pesan`, `kodepos`, `kd_skincare`, `jumlah`, `kd_voucher`, `metode_pembayaran`, `total_harga`, `status`) VALUES (NULL, '$usn', NOW(), '$kdpos', '$kdskincare', '$jumlah', '$kdvoucher', '$metode', '$total', '$status');");
    }

    if ($input == true) {
        echo "<script>alert('Pembelian Diproses');
            window.location.href=('produkpage.php');</script>";
        if ($metode === "e5") {
            PostTransaction($no_rekening, $total);
        }
    } else {
        echo "<script>alert('Pembelian GAGAL');</script>";
    }
} else {
    echo "<script>alert('Metode Pembayaran tidak valid');</script>";
}

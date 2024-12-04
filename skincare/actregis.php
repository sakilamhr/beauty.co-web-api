<?php
include "koneksi.php";

$nama = $_POST['nama'];
$usn = $_POST['username'];
$pass = $_POST['pass'];
$nowa = $_POST['nowa'];
$email = $_POST['email'];
$level = $_POST['level'];
$kdpos = $_POST['kodepos'];
$alamat = $_POST['alamat'];
$kota = $_POST['kota'];


$b = $koneksi -> query("INSERT INTO `tb_kota` (`kodepos`, `kota`, `alamat`) VALUES ('$kdpos', '$kota', '$alamat');");

$a = $koneksi -> query("INSERT INTO `tb_data` (`username`, `nama_lengkap`, `password`, `kodepos`, `no_wa`, `email`, `level`) VALUES ('$usn', '$nama', '$pass', '$kdpos', '$nowa', '$email', '$level');");



if ($a == true){
    echo "<script>alert('Registration succesfull');
        window.location.href=('loginpage.php');</script>";
}else{
    
}




?>
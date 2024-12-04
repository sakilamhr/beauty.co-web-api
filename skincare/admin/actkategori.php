<?php 
include "../koneksi.php";

$id=$_POST['idkategori'];
$kategori=$_POST['kategori'];

if($_GET['hal'] == "edit")
{
    //data di edit
    $edit = $koneksi -> query("UPDATE tb_kategori SET id_kategori = '$id', kategori = '$kategori' 
                                WHERE id_kategori = '$id'");

    if ($edit == true){
        echo "<script>alert('Edit SUKSES');
            window.location.href=('kategori.php');</script>";
    }else{
    echo "<script>alert('Edit GAGAL');
        window.location.href=('kategori.php');</script>";
    }
}else{
    //data disimpan baru
    $insert = $koneksi -> query("INSERT INTO `tb_kategori` (id_kategori, kategori) VALUES ('$id', '$kategori');");

    if ($insert == true){
        echo "<script>alert('Input SUKSES');
            window.location.href=('kategori.php');</script>";
    }else{
    echo "<script>alert('Input GAGAL');
        window.location.href=('kategori.php');</script>";
    }
}


?>
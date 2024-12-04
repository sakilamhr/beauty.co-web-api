<?php
session_start();
include "koneksi.php";

$usn = $_POST['username'];
$pass = $_POST['pass'];

$sql = mysqli_query($koneksi, "SELECT * FROM tb_data WHERE username='$usn' AND password='$pass'");

if(mysqli_num_rows($sql) == 1){
    $a = $sql -> fetch_array();

    if($a['level'] == "1"){
        $_SESSION['username'] = $usn;
        $_SESSION['level'] = '1';
        echo "<script>alert('Admin Login Succesfull');
        window.location.href=('adminpage.php');</script>";
    }else if($a['level'] == "2"){
        $_SESSION['username'] = $usn;
        $_SESSION['level'] = '2';
        echo "<script>alert('User Login Succesfull');
        window.location.href=('homepage.php');</script>";
    }else{
        echo "<script>alert('Login Unsuccesfull');
        window.location.href=('loginpage.php');</script>";
    }

}else{
    echo "<script>alert('Username or Password is Wrong');
        window.location.href=('loginpage.php');</script>";
}

?>
<?php 
    session_start();
    include "koneksi.php";

    if($_SESSION['username'] != true){
        echo '<script>window.location="loginpage.php"</script>';
    }


        $nama = $_POST['nama'];
        $usn = $_POST['username'];
        $pass = $_POST['pass'];
        $nowa = $_POST['nowa'];
        $email = $_POST['email'];
        $level = $_POST['level'];
        $kdpos = $_POST['kodepos'];
        $alamat = $_POST['alamat'];
        $kota = $_POST['kota'];



        $update = mysqli_query($koneksi, "UPDATE tb_data SET nama_lengkap = '".$nama."',
                                                            username = '".$usn."',
                                                            password = '".$pass."',
                                                            no_wa = '".$nowa."',
                                                            email = '".$email."' 
                                                            where username='".$_SESSION['username']."'");

        if($update == true){
            echo '<script>alert("Update Profil Berhasil")</script>';
            echo '<script>window.location="aboutpage.php"</script>';
        }else{
            echo "error";
        }
    
?>
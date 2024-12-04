
        <?php
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "tokoskincare";
        $koneksi = mysqli_connect($host, $username, $password, $database);
        if ($koneksi){
        } else {
            echo "Server not Connected";
        }
        ?>

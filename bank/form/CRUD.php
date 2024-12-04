<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}



if (isset($_GET['stts']) && $_GET['stts'] == 'tambah_nasabah') {

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nama_ibu = $_POST['nama_ibu'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    // Query untuk menambah nasabah
    $sql = "INSERT INTO nasabah (nama_lengkap, email, nomor_telepon, alamat, jenis_kelamin, nama_ibu, tanggal_lahir) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Mempersiapkan statement
    if ($stmt = $koneksi->prepare($sql)) {
        // Mengikat parameter
        $stmt->bind_param("sssssss", $nama, $email, $no_telepon, $alamat, $jenis_kelamin, $nama_ibu, $tanggal_lahir);

        // Eksekusi statement
        if ($stmt->execute()) {
            header("Location: ../nasabahMenu.php"); // Redirect ke halaman nasabahMenu.php
            exit();
        } else {
            echo "<script>alert('Gagal menyimpan data.'); window.history.back();</script>";
        }

        // Menutup statement
        $stmt->close();
    }
} elseif (isset($_GET['stts']) && $_GET['stts'] == 'ubah_data_nasabah') {

    // Ambil data dari POST
    $id_nasabah = $_POST['id_nasabah'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nama_ibu = $_POST['nama_ibu'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    // Siapkan query SQL
    $sql = "UPDATE nasabah SET 
                nama_lengkap = ?, 
                email = ?, 
                nomor_telepon = ?, 
                alamat = ?, 
                jenis_kelamin = ?, 
                nama_ibu = ?, 
                tanggal_lahir = ? 
            WHERE id_nasabah = ?";

    if ($stmt = $koneksi->prepare($sql)) {
        // Mengikat parameter (s = string, i = integer, d = double, b = blob)
        $stmt->bind_param("sssssssi", $nama, $email, $no_telepon, $alamat, $jenis_kelamin, $nama_ibu, $tanggal_lahir, $id_nasabah);

        // Eksekusi statement
        if ($stmt->execute()) {
            header("Location: ../nasabahMenu.php");
            exit();
        } else {
            echo "<script>alert('Gagal menyimpan data.'); window.history.back();</script>";
        }

        // Menutup statement
        $stmt->close();
    } else {
        echo "<script>alert('Gagal menyiapkan query.'); window.history.back();</script>";
    }
} elseif (isset($_GET['stts']) && $_GET['stts'] == 'deletenasabah') {
    $id_nasabah = intval($_GET['id']);

    $sql = "DELETE from nasabah where id_nasabah = ?";

    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("i",  $id_nasabah);
        if ($stmt->execute()) {
            header("Location: ../nasabahMenu.php"); // Redirect ke halaman nasabahMenu.php
            exit();
        } else {
            echo "<script>alert('Gagal menyimpan data.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Gagal menyimpan data.'); window.history.back();</script>";
    }
} elseif (isset($_GET['stts']) && $_GET['stts'] == 'daftarRekening') {
    $no_rekening = $_POST['no_rekening'];
    $id_nasabah = $_POST['id_nasabah'];
    $saldo = $_POST['saldo'];

    // Cek apakah nomor rekening sudah ada
    $cek_sql = "SELECT no_rekening FROM rekening WHERE no_rekening = '$no_rekening'";
    $result = $koneksi->query($cek_sql);

    if ($result->num_rows > 0) {
        // Jika nomor rekening sudah ada, tampilkan alert dan gunakan history.back()
        echo "<script>
                    alert('Nomor rekening sudah terdaftar. Gunakan nomor rekening yang berbeda.');
                    history.back();
                  </script>";
        exit();
    } else {
        // Jika nomor rekening belum ada, lanjutkan dengan proses insert
        $sql = "INSERT INTO rekening (no_rekening, id_nasabah, saldo) VALUES ('$no_rekening', '$id_nasabah', '$saldo')";

        if ($koneksi->query($sql) === TRUE) {
            echo "<script>
                        alert('Rekening berhasil ditambahkan');
                       
                      </script>";
            header("Location: ../rekeningMenu.php");

            exit();
        } else {
            echo "<script>
                        alert('Terjadi kesalahan saat menambahkan rekening.');
                        history.back();
                      </script>";
            exit();
        }
    }
} elseif (isset($_GET['stts']) && $_GET['stts'] == 'tambahSaldo') {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $no_rekening = $_POST['no_rekening'];
        $saldo_tambahan = $_POST['saldo'];


        $sql_check_rekening = "SELECT * FROM rekening WHERE no_rekening = '$no_rekening' LIMIT 1";
        $result_check_rekening = $koneksi->query($sql_check_rekening);
        $a = $result_check_rekening->fetch_assoc();
        $id_rekening = $a['id_rekening'];

        if ($result_check_rekening->num_rows > 0) {

            $sql_update = "UPDATE rekening SET saldo = saldo + $saldo_tambahan WHERE no_rekening = '$no_rekening'";

            if ($koneksi->query($sql_update) === TRUE) {

                // insert data trasnsaksi
                $sql = "INSERT INTO transaksi (id_rekening,jumlah_transaksi,jenis_transaksi)VALUES ($id_rekening,$saldo_tambahan,'Isi saldo') ";
                if ($koneksi->query($sql) === TRUE) {
                    $_SESSION['success'] = "Saldo berhasil ditambahkan.";
                } else {
                    $_SESSION['error'] = "Terjadi kesalahan saat menambahkan saldo: " . $koneksi->error;
                }
            } else {
                $_SESSION['error'] = "Terjadi kesalahan saat menambahkan saldo: " . $koneksi->error;
            }
        } else {
            $_SESSION['error'] = "Nomor rekening tidak valid.";
        }

        header("Location: tambahSaldo.php");
        exit();
    }
} else {
    echo "<script>alert('Gagal menyiapkan query.'); window.history.back();</script>";
}


// Menutup koneksi
$conn->close();

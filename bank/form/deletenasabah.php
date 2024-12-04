<?php
session_start();
include "../koneksi.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_nasabah = $_GET['id']; // Pastikan id_nasabah adalah integer

    $sql = "DELETE FROM nasabah WHERE id_nasabah = ?";

    if ($stmt = $koneksi->prepare($sql)) {
        $stmt->bind_param("i", $id_nasabah);
        if ($stmt->execute()) {
            header("Location: ../nasabahMenu.php"); // Redirect ke halaman nasabahMenu.php
            exit();
        } else {
            echo "<script>
                alert('Gagal menghapus data.');
                window.history.back();
            </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
            alert('Gagal mempersiapkan pernyataan.');
            window.history.back();
        </script>";
    }
} else {
    echo "<script>
        alert('ID tidak valid.');
        window.history.back();
    </script>";
}

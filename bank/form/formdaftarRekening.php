<?php
session_start();
include "../koneksi.php";

// Redirect jika tidak ada sesi atau jika bukan admin
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Rekening</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-10 max-w-3xl">
        <h2 class="text-3xl font-bold text-indigo-600 text-center mb-6">Form Daftar Rekening Baru</h2>

        <form action="CRUD.php?stts=daftarRekening" method="POST" class="mt-4 bg-white p-8 rounded-lg shadow-lg">
            <div class="mb-6">
                <label for="no_rekening" class="block text-sm font-medium text-gray-700">No Rekening</label>
                <input type="text" id="no_rekening" name="no_rekening" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2" />
            </div>

            <div class="mb-6">
                <label for="id_nasabah" class="block text-sm font-medium text-gray-700">Nasabah</label>
                <select id="id_nasabah" name="id_nasabah" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2">
                    <option value="">Pilih Nasabah</option>
                    <?php
                    // Ambil daftar nasabah dari database
                    $sql_nasabah = "SELECT id_nasabah, nama_lengkap FROM nasabah";
                    $result_nasabah = $koneksi->query($sql_nasabah);

                    if ($result_nasabah->num_rows > 0) {
                        while ($nasabah = $result_nasabah->fetch_assoc()) {
                            echo "<option value='{$nasabah['id_nasabah']}'>{$nasabah['nama_lengkap']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-6">
                <label for="saldo" class="block text-sm font-medium text-gray-700">Saldo Awal</label>
                <input type="number" id="saldo" name="saldo" required min="0" step="0.01"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2" />
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white hover:bg-indigo-700 px-4 py-2 rounded-md transition duration-200">
                Daftar Rekening
            </button>
            <a href="../rekeningMenu.php" class="block mt-4 text-center text-gray-600 hover:text-gray-800">Kembali</a>
        </form>
    </div>

</body>

</html>
<?php
session_start();
include "../koneksi.php";

// Redirect jika tidak ada sesi atau bukan admin
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Mengambil daftar rekening dari database
$sql_rekening = "SELECT rekening.no_rekening , nasabah.nama_lengkap FROM rekening JOIN nasabah ON nasabah.id_nasabah = rekening.id_nasabah";
$result_rekening = $koneksi->query($sql_rekening);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Saldo Rekening</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto mt-10 max-w-3xl">
        <h2 class="text-3xl font-bold text-indigo-600 text-center mb-6">Form Tambah Saldo Rekening</h2>

        <?php
        // Menampilkan pesan sukses atau error
        if (isset($_SESSION['success'])) {
            echo "<div class='bg-green-500 text-white p-4 rounded mb-4'>" . $_SESSION['success'] . "</div>";
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo "<div class='bg-red-500 text-white p-4 rounded mb-4'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
        }
        ?>

        <form action="CRUD.php?stts=tambahSaldo" method="POST" class="mt-4 bg-white p-8 rounded-lg shadow-lg">
            <div class="mb-6">
                <label for="no_rekening" class="block text-sm font-medium text-gray-700">No Rekening</label>
                <select id="no_rekening" name="no_rekening" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2">
                    <option value="">Pilih Rekening</option>
                    <?php
                    if ($result_rekening->num_rows > 0) {
                        while ($rekening = $result_rekening->fetch_assoc()) {
                    ?>
                            <option value='<?php echo $rekening['no_rekening'] ?>'>
                                <?php echo  $rekening['no_rekening'] . ' a/n ' . $rekening['nama_lengkap'] ?>
                            </option>";

                    <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-6">
                <label for="saldo" class="block text-sm font-medium text-gray-700">Saldo Tambahan</label>
                <input type="number" id="saldo" name="saldo" required min="0" step="0.01"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2" />
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white hover:bg-indigo-700 px-4 py-2 rounded-md transition duration-200">
                Tambah Saldo
            </button>
            <a href="../rekeningMenu.php" class="block mt-4 text-center text-gray-600 hover:text-gray-800">Kembali</a>
        </form>
    </div>

</body>

</html>
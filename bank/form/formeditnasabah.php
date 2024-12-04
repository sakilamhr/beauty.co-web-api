<?php
session_start();
include "../koneksi.php";
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}


if (isset($_GET['id'])) {
    $id_nasabah = $_GET['id'];

    $sql = "SELECT * FROM nasabah where id_nasabah = $id_nasabah";
    $result = $koneksi->query($sql);

    $a = $result->fetch_assoc();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nasabah</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="w-full max-w-md mx-auto my-8 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-center text-indigo-600">Ubah Data Nasabah</h2>
        <form action="CRUD.php?stts=ubah_data_nasabah" method="POST">
            <input type="hidden" id="id_nasabah" name="id_nasabah" required value="<?php echo $a['id_nasabah'] ?>"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required value="<?php echo $a['nama_lengkap'] ?>"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required value="<?php echo $a['email'] ?>"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="no_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input type="tel" id="no_telepon" name="no_telepon" required value="<?php echo $a['nomor_telepon'] ?>"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea id="alamat" name="alamat" required rows="3"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"><?php echo htmlspecialchars($a['alamat']); ?></textarea>
            </div>

            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="" disabled>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" <?php echo ($a['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>
                        Laki-laki</option>
                    <option value="Perempuan" <?php echo ($a['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>
                        Perempuan</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="nama_ibu" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                <input type="text" id="nama_ibu" name="nama_ibu" required value="<?php echo $a['nama_ibu'] ?>"
                    class=" mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" required
                    value="<?php echo date('Y-m-d', strtotime($a['tanggal_lahir'])); ?>"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            </div>


            <div class="flex justify-end mt-8">
                <button type="submit"
                    class="bg-indigo-500 w-full text-white hover:bg-indigo-600 px-4 py-2 rounded-md transition duration-200">
                    Ubah Data Nasabah
                </button>
            </div>
        </form>
    </div>
</body>

</html>
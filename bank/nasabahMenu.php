<?php
session_start();
include "koneksi.php";
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header("Location:
    login.php");
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nasabah</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <?php
    include "navbar.php";
    ?>
    <!-- Konten Nasabah -->
    <div class="mt-8 px-10 pb-4">
        <div class="flex flex-row justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-indigo-600">Data Nasabah</h2>
            <a href="form/formtambahnasabah.php"
                class="bg-indigo-400 text-white hover:bg-indigo-600 px-4 py-2 rounded-md transition duration-200">
                Tambah Nasabah
            </a>
        </div>
    </div>

    <div class="overflow-x-auto mx-10">
        <table class="min-w-full bg-white border border-gray-300">

            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Ibu
                        Kandung
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.
                        Telepon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis
                        Kelamin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal Lahir</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tanggal Bergabung</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                    </th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM nasabah";
                $result = $koneksi->query($sql);
                if ($result->num_rows > 0) {

                    while ($a = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td class="px-6 py-4"><?php echo $a['id_nasabah'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $a['nama_lengkap'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $a['email'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $a['nama_ibu'] ?></td>

                    <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap"><?php echo $a['nomor_telepon'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $a['alamat'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $a['jenis_kelamin'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $a['tanggal_lahir'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap"><?php echo $a['tanggal_bergabung'] ?></td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href='form/formeditnasabah.php?id=<?php echo $a["id_nasabah"]; ?>'
                            class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <br>
                        <a href="#" class="text-red-600 hover:text-red-900"
                            onclick="alertDelete('<?php echo $a['id_nasabah']; ?>'); return false;">Hapus</a>
                    </td>
                <tr>

                    <?php
                    }
                } else {
                        ?>

                    <td colspan=' 8' class='px-6 py-4 text-center'>Tidak ada data nasabah.
                    </td>
                </tr>
                <?php
                }
                    ?>

                </tr>

            </tbody>
        </table>
    </div>
    </>


</body>

</html>

<script>
function alertDelete(id) {
    // Menampilkan konfirmasi kepada pengguna
    if (confirm('Apakah Anda yakin ingin menghapus nasabah ini?')) {

        window.location.href = 'form/CRUD.php?stts=deletenasabah&id=' + id;
    } else {
        // Jika pengguna membatalkan, tidak melakukan apa-apa
        alert('Penghapusan dibatalkan.');
    }
}
</script>
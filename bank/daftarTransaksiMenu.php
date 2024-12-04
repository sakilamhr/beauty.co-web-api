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
            <h2 class="text-2xl font-bold text-indigo-600">Daftar Transaksi</h2>
            <div class="flex flex-row gap-4">

                <a href="#"
                    class="bg-indigo-400 text-white hover:bg-indigo-600 px-4 py-2 rounded-md transition duration-200">
                    Transfer
                </a>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto mx-10">
        <table class="min-w-full bg-white border border-gray-300">

            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NO
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        Transaksi
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                        Rekening
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rekening
                        Tujuan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah
                        Transaksi
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Jenis Transaksi</th>

                </tr>
            </thead>
            <tbody>

                <?php
                $no = 1;
                $sql = "SELECT transaksi.*, rekening.*, nasabah.nama_lengkap FROM transaksi JOIN rekening ON rekening.id_rekening = transaksi.id_rekening JOIN nasabah ON nasabah.id_nasabah = rekening.id_nasabah";
                $result = $koneksi->query($sql);
                if ($result->num_rows > 0) {

                    while ($a = $result->fetch_assoc()) {
                        $tanggal_transaksi = $a['tanggal_transaksi'];
                        $formatted_date = date("D, d/m/Y - h:m:s", strtotime($tanggal_transaksi));

                ?>
                        <tr>
                            <td class="px-6 py-4"><?php echo $no++ ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $formatted_date; ?></td>
                            <td class="px-6 py-4"><?php echo $a['no_rekening'] ?></td>
                            <td class="px-6 py-4"><?php echo $a['rekening_tujuan'] ?></td>
                            <td class="px-6 py-4">Rp. <?php echo number_format($a['jumlah_transaksi'], '0', ',', '.') ?></td>
                            <td class="px-6 py-4"><?php echo $a['jenis_transaksi'] ?></td>
                        <tr>

                        <?php
                    }
                } else {
                        ?>

                        <td colspan=' 8' class='px-6 py-4 text-center'>Tidak ada data rekening
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
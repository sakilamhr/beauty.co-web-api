<?php


function PostTransaction($no_rekening, $jumlah_transaksi)
{


    $url = "http://bank-server.test/api/transaksi?apiKey=qwged76jkxndcshjvjasv"; // Ganti dengan URL endpoint API bank
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
        CURLOPT_POSTFIELDS,
        http_build_query(array(
            'no_rekening' => $no_rekening,
            'jumlah_transaksi' => $jumlah_transaksi,
            "rekening_tujuan" => "098765"
        ))
    );

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        return null; // Jika error, return null
    }

    curl_close($ch);


    $dataBank = json_decode($response, true);

    // Simpan data API ke cache jika berhasil
    return $dataBank;
}

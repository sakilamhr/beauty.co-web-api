<?php

function showBlog()
{

    $api_key = 'qwertyuiop';
    $url = "http://artikel.test/api/articles/keperawatan?apiKey={$api_key}";

    // Inisialisasi cURL
    $curl = curl_init();

    // Setel opsi cURL
    curl_setopt($curl, CURLOPT_URL, $url);               // Set URL API
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);    // Ambil respons sebagai string
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Accept: application/json'
    ]);


    $eksekusi = curl_exec($curl);

    // Cek jika ada error atau status kode bukan 200
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if (curl_errno($curl)) {
        echo 'Error: ' . curl_error($curl);
        curl_close($curl);
        return null;
    } elseif ($http_code !== 200) {
        echo "Error: Permintaan gagal dengan status HTTP $http_code.";
        curl_close($curl);
        return null;
    }

    // Tutup cURL setelah dieksekusi
    curl_close($curl);

    // Decode JSON
    $articles = json_decode($eksekusi, true);

    if ($articles === null && json_last_error() !== JSON_ERROR_NONE) {
        echo 'Error: Gagal memproses data dari API.';
        return null;
    }

    return $articles;
}

function showDetail($id)
{

    $api_key = 'qwertyuiop';
    $url = "http://artikel.test/api/articles/keperawatan/{$id}?apiKey={$api_key}";

    // Inisialisasi cURL
    $curl = curl_init();

    // Setel opsi cURL
    curl_setopt($curl, CURLOPT_URL, $url);               // Set URL API
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);    // Ambil respons sebagai string
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Accept: application/json'
    ]);


    $eksekusi = curl_exec($curl);

    // Cek jika ada error atau status kode bukan 200
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if (curl_errno($curl)) {
        echo 'Error: ' . curl_error($curl);
        curl_close($curl);
        return null;
    } elseif ($http_code !== 200) {
        echo "Error: Permintaan gagal dengan status HTTP $http_code.";
        curl_close($curl);
        return null;
    }

    // Tutup cURL setelah dieksekusi
    curl_close($curl);

    // Decode JSON
    $articles = json_decode($eksekusi, true);

    if ($articles === null && json_last_error() !== JSON_ERROR_NONE) {
        echo 'Error: Gagal memproses data dari API.';
        return null;
    }

    return $articles;
}
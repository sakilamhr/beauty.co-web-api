<?php
include 'koneksi.php';
include 'api_artikel.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css/styleprofile.css">
</head>

<body class="bg-gray-100">
    <?php

    include "navbar.php";
    ?>

    <?php

    $articles = showBlog();
    foreach ($articles['data'] as $article) {
    ?>

    <div
        class="flex flex-wrap md:flex-nowrap bg-white shadow-md rounded-lg overflow-hidden mb-6 mx-4 my-4 md:mx-14 md:my-12 max-w-8xl justify-center">
        <!-- Image Section -->
        <div class="w-full md:w-1/3 h-48 md:h-auto">
            <img src="<?php echo $article['image'] ?? 'https://via.placeholder.com/150'; ?>" alt="Gambar Artikel"
                class="w-full h-full object-cover">
        </div>

        <!-- Content Section -->
        <div class="w-full md:w-2/3 p-4">
            <div class="text-gray-500 text-sm mb-1">
                <?php echo date('d F Y', strtotime($article['created_at'])); ?>
            </div>

            <div class="flex items-center mb-2">
                <p class="text-gray-700">Author: <?php echo htmlspecialchars($article['author']['name']); ?> | Category:
                    <?php echo htmlspecialchars($article['category']); ?></p>
            </div>

            <h1 class="text-xl font-bold mb-2"><?php echo htmlspecialchars($article['title']); ?></h1>
            <p class="text-gray-700 mb-4 leading-relaxed">
                <?php echo (mb_strimwidth($article['body'], 0, 120, "...")); ?>
            </p>

            <a href="detail_artikel.php?id=<?php echo $article['id']; ?>" class="text-blue-500 font-semibold">Continue
                reading →</a>
        </div>
    </div>
    <?php
    }
    ?>
</body>

</html>
<?php  
$target_dir = "uploads/"; 
$target_file = $target_dir . basename($_FILES["file"]["name"]); 
$uploadOk = 1; 

if (file_exists($target_file)) {
    echo "Maaf, file tersebut sudah ada.";
    $uploadOk = 0;
}

$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
    echo "Maaf, hanya file JPG, JPEG, PNG, & GIF yang diizinkan.";
    $uploadOk = 0;
}

if ($uploadOk == 1) {
   move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)
}
?>
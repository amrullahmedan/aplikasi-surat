<?php
require_once("koneksi.php");
$no_id = $_POST["no_id"];

$eror = false;
$folder = 'img/';
$max_size = 1000000000;
$file_type = array('jpg','jpeg','png','gif','PNG','JPG','JPEG','GIF');
if (isset($_POST['btnUpload'])) {
    $file_name = $_FILES['data_upload']['name'];
    $file_size = $_FILES['data_upload']['size'];
    $explode = explode('.', $file_name);
    $extensi = $explode[count($explode)-1];
    if (!in_array($extensi, $file_type)) {
        $eror = true;
        $pesan = 'file yang anda upload tidak sesuai';
    }
    if ($file_size > $max_size) {
        $eror = true;
        $pesan = 'file yg anda upload terlalu besar';
    }
    if ($eror == true ) {
         echo "$pesan";
         header('location:index.php');
    }else{
        if (move_uploaded_file($_FILES['data_upload']['tmp_name'], $folder.$file_name)) {
            $file_img = $file_name;
        }else{
             echo "Terjadi Kesalahan Saat Upload file";
        }
        $sql = "UPDATE user SET picture='$file_img' WHERE id='$no_id'";

                                if ($conn->query($sql) == TRUE) {
                                    header("location:index.php"); 
                                } else {
                                    echo "Error updating record: " . mysqli_error($conn);
                                }
    }
}
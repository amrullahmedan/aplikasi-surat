<?php
 require_once("koneksi.php");
$x = $_REQUEST['id'];
$sql = "UPDATE mail SET status='arsip' WHERE id='$x'";

if ($conn->query($sql) === TRUE) {
    header("location:suratmasuk.php");
} else {
    header("location:suratmasuk.php?hasil=gagal");
}

?>
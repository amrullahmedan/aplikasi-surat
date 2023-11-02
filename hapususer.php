<?php
require_once("koneksi.php");
$no = $_REQUEST['id'];
$sql = "DELETE FROM user WHERE id='$no'";

if (mysqli_query($conn, $sql)) {
    header("location:user.php?hasil=hapus"); }
    else {
    header("location:user.php?hasil=gagalhapus"); }

mysqli_close($conn);
?>
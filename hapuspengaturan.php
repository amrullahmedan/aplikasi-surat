<?php
require_once("koneksi.php");
$no = $_REQUEST['id'];
$sql = "DELETE FROM mail_type WHERE id=$no";

if (mysqli_query($conn, $sql)) {
    header("location:pengaturan.php?hasil=hapus"); }
    else {
    header("location:pengaturan.php?hasil=gagalhapus"); }

mysqli_close($conn);
?>
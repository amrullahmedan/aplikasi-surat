<?php
require_once("koneksi.php");
$no = $_REQUEST['id'];
$sql = "DELETE FROM disposition WHERE mailid='$no'";

if (mysqli_query($conn, $sql)) {
	$sql = "UPDATE mail SET disposisi='belum', status='tidak' WHERE id='$no'";
	if ($conn->query($sql) == TRUE) {
		header("location:disposisisurat.php?hasil=hapus");
	}else{
		echo $conn->error;
	}
}else {
    header("location:disposisisurat.php?hasil=gagalhapus"); }
mysqli_close($conn);
?>
<?php
require_once("koneksi.php");
$no = $_REQUEST['id'];
$sql = "SELECT * FROM mail WHERE id='$no'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $file = $row["file_upload"];
	    $target = "upload/".$file;
$sqldel = "DELETE FROM mail WHERE id='$id'";

if (mysqli_query($conn, $sqldel)) {
    //delete disposisi jika ada
    $sqldis = "SELECT * FROM disposition WHERE mailid='$no'";
        $resultdis = mysqli_query($conn, $sqldis);
        if ($resultdis->num_rows > 0) {
            $sqldeldis = "DELETE FROM disposition WHERE mailid='$id'";
             $resultdel = mysqli_query($conn, $sqldeldis);
        }

	if (file_exists($target)){
	unlink($target);
	}
    header("location:suratmasuk.php?hasil=hapus"); }
    else {
    header("location:suratmasuk.php?hasil=gagalhapus"); }
}
}
mysqli_close($conn);
?>
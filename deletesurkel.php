<?php
require_once("koneksi.php");
$no = $_REQUEST['id'];
$sql = "SELECT * FROM mail_out WHERE id='$no'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $file = $row["file_upload"];
	    $target = "upload/".$file;
$sqldel = "DELETE FROM mail_out WHERE id='$id'";

if (mysqli_query($conn, $sqldel)) {
	if (file_exists($target)){
	unlink($target);
	}
    header("location:suratkeluar.php?hasil=hapus"); }
    else {
    header("location:suratkeluar.php?hasil=gagalhapus"); }
}
}
mysqli_close($conn);
?>
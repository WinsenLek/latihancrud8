<?php 
$conn = new mysqli("localhost", "root", "", "latihan");

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_GET ['nim'])){
	$delete = mysqli_query($conn, " DELETE FROM mahasiswa WHERE nim ='".$_GET ['nim']."' ");
	header('location:mahasiswa.php?');
}
?>

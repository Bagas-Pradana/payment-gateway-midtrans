<?php
// Load file koneksi.php
include "config2.php";

// Ambil data NIS yang dikirim oleh index.php melalui URL
$id = $_GET['id'];

// Query untuk menampilkan datayang dikirim
$query = "SELECT * FROM data WHERE id='".$id."'";
$sql = mysqli_query($konek, $query); // Eksekusi/Jalankan query dari variabel $query
$data = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql

// Query untuk menghapus datayang dikirim
$query2 = "DELETE FROM data WHERE id='".$id."'";
$sql2 = mysqli_query($konek, $query2); // Eksekusi/Jalankan query dari variabel $query

if($sql2){ // Cek jika proses simpan ke database sukses atau tidak
	// Jika Sukses, Lakukan :
	header("Location: data.php"); // Redirect ke halaman index.php
}else{
	// Jika Gagal, Lakukan :
	echo "Data gagal dihapus. <a href='config2.php'>Kembali</a>";
}
?>
<?php
// <center><h2>2211501388 ATHALLA RAKHA SYAFA'AT</h2></center>

$host = "localhost";
$user = "root"; // adjust according to your mysql setting
$pass = ""; // adjust according to your mysql setting
$dbName = "db_pemketir_2211501388";
$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
    die("koneksi Mysqll Gagal !!<br>" . mysqli_connect_error());
}

echo "koneksi MySql Berhasil !! <br>";

$sql = mysqli_select_db($conn, $dbName);
if (!$sql) {
    die("koneksi Database Gagal !!" . mysqli_error($conn));
}
echo ("Koneksi Database Berhasil");
?>
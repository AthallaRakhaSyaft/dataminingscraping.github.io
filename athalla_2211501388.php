<!DOCTYPE html>
<html>
<head>
    <title>Tahap Klasifikasi Data Dengan Algoritma Naive Bayes</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <script type="text/javascript" arc="bootstrap/js/jquery.js"></script>
</head>
<body>
<table class="table table-bordered table-striped">
    <td colspan="3">
    <button onclick="goBack()">Kembali Ke Form Input Link</button>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
        </td>
</table>
<br>

<?php
require_once "Koneksi_2211501388.php";


$sql = "delete FROM probabilitas_kategori_2211501388";
$result0 = mysqli_query($conn,$sql);

$sql = "SELECT * FROM kategori_2211501388 order by id_kategori";
$result1 = $conn->query($sql);
if ($result1->num_rows == 0) {
    echo "Data Tidak Ditemukan";
}else{
    while($d = mysqli_fetch_array($result1)) {
       $id = $d['id_kategori'];

        $sql = "SELECT count(*) as jml FROM preprocessing_2211501388 where id_kategori='$id'";
        $result2 = $conn->query($sql);
        $d = mysqli_fetch_row($result2);
        $jmlkategori = $d[0];

        $sql = "SELECT count(*) jml FROM preprocessing_2211501388";
        $result3 = $conn->query($sql);
        $d = mysqli_fetch_row($result3);
        $jmldokumen = $d[0];

        $nilai=$jmlkategori/$jmldokumen;

        $q = "INSERT INTO probabilitas_kategori_2211501388(id_kategori,jml_data,nilai_probabilitas)
                VALUES('$id','$jmlkategori','$nilai')";

        $result4 = mysqli_query($conn,$q);
    }
}

$sql = "SELECT nm_kategori,jml_data,nilai_probabilitas FROM probabilitas_kategori_2211501388 a,kategori_2211501388 b
        where a.id_kategori=b.id_kategori order by 1";
$result4 = $conn->query($sql);
?>

<table class="table table-bordered table-striped table-hover">
<thead>
    <br><br><tr></tr>
<tr>
    <td colspan="5"><strong>Nilai Probabilitas Pada Setiap Kategori</strong></td>
</tr>
<tr bgcolor="$CCCCCC">
<th>No.</th>
<th>Kategori</th>
<th>Frekuensi Dokumen Per Kategori</th>
<th>Jumlah Seluruh Dokumen</th>
<th>Probabilitas</th>
</tr>
</thead>
    <?php
        $i=1;
        while($d = mysqli_fetch_array($result4)) {
        ?>
            <tr bgcolor="#FFFFFF">
                <td><?php echo $i; ?></td>
                <td><?php echo $d[0]; ?></td>
                <td><?php echo $d[1]; ?></td>
                <td><?php echo $jmldokumen; ?></td>
                <td><?php echo $d[2]; ?></td>
            </tr>
        <?php 
            $i=$i+1;
        }
        ?>
</table>

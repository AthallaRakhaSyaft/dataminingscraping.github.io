<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tahap Klasifikasi Data Dengan Algoritma Naive Bayes</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <script type="text/javascript" src="bootstrap/js/jquery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
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
require_once "fungsi_2211501388.php";
//die ("test");

$sql = "UPDATE classify_2211501388 set id_predicted=null";
$result = mysqli_query($conn,$sql);

//$sql = "SELECT * FROM classify_2211501388"; // untuk data uji yang diambil dari tabel classify
$sql = "SELECT * FROM preprocessing_2211501388 where id_kategori is null";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "Data Tidak Ditemukan";
}else{
    $tmpnilai=0;
    while($d = mysqli_fetch_array($result)){
                $data = $d['data_bersih'];

                echo "<br>";
                echo "Data Uji ==> ",$data;
                
                $data_array=explode(" ",$data);
                $str_data=array();
                foreach($data_array as $value) {
                     $str_data[] = "".$value;
                     $kata=$value;

                     $sql = "SELECT * FROM probabilitas_kata_2211501388 where kata='$kata'";
                     $result2 = $conn->query($sql);

                     if ($result2->num_rows > 0) {
                         while($d = mysqli_fetch_array($result2)) {
                             $nilai = $d[3];
                             $id = $d[1];
                             $jml = $d[2];

                             //TMP Nilai probabilitas_2211501388 per kategori_2211501388
                             $tmpnilai = (getTMPNilai($conn,$id));
                             if ($tmpnilai <=0 ) {
                                 $tmpnilai=1;
                             }

                         (float)$totnilai= (float)($tmpnilai*$nilai);

                         $sql = "SELECT * FROM probabilitas_kategori_2211501388 where id_kategori='$id'";
                         $result3 = $conn->query($sql);
                         if ($result3->num_rows > 0) {
                             $q = "UPDATE probabilitas_kategori_2211501388 set tmp_nilai='$totnilai' WHERE id_kategori='$id'";

                             $result3 = mysqli_query($conn,$q);
                         }
                     } 
                }
    }

    $nilaitertinggi= getNilaiTertinggi($conn);
    $id_kategori=0;
    if ($nilaitertinggi != 0){
        $id_kategori=getKatTerpilih($conn);
    }

    if ($id_kategori ==0) {
        echo " ==> Kategori Tidak Ditemukan";
    }else{
    echo " ==> Kategori Tertinggi : ".getNmKategori($conn,$id_kategori)." (".$nilaitertinggi." )";
    }

    $sql = "SELECT * FROM classify_2211501388 where data_bersih='$data'";
    $result4 = $conn->query($sql);

    if ($result4->num_rows > 0) {
        $q = "UPDATE classify_2211501388 set id_predicted='$id_kategori' WHERE data_bersih='$data'";

        $result4 = mysqli_query($conn,$q);
    }else{
        $q = "INSERT into classify_2211501388(data_bersih,id_predicted) values ('$data','$id_kategori')";

        $result4 = mysqli_query($conn,$q);
    }

    $q = "UPDATE probabilitas_kategori_2211501388 set tmp_nilai=0";
    $result3 = mysqli_query($conn,$q);
    }
}
?>
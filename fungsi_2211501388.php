<?php 
  //nama kategori 
 function getNmKategori ($conn, $kat) {
     $sql="SELECT nm_kategori FROM kategori_2211501388 where id_kategori='$kat'";
     $rs=$conn->query($sql);
     $d = mysqli_fetch_row($rs);
     $nm_kategori = $d[0];
     return $nm_kategori;
 }

 //TMP Nilai probabilitas per kategori
 function getTMPNilai ($conn, $id) {
   $sql="SELECT tmp_nilai from probabilitas_kategori_2211501388 where id_kategori='$id'";
   $rs=$conn->query($sql);
   $d = mysqli_fetch_row($rs);
   $tmp_nilai = $d[0];
   return $tmp_nilai;
 }

 //kategori dengan nilai tertinggi/maksimal 
 function getNilaiTertinggi ($conn) {
    $sql="SELECT max(nilai_probabilitas*tmp_nilai) FROM probabilitas_kategori_2211501388";
    $rs=$conn->query($sql);
    $d = mysqli_fetch_row($rs);
    $nilai = $d[0];
    return $nilai; 
 }

 //kategori terpilih 
 function getKatTerpilih ($conn) {
     $sql="SELECT * FROM probabilitas_kategori_2211501388
     WHERE (nilai_probabilitas*tmp_nilai)=(SELECT max(nilai_probabilitas*tmp_nilai) FROM probabilitas_kategori_2211501388)";
     $rs=$conn->query($sql);
     $d = mysqli_fetch_row($rs);
     $id = $d[0];
     return $id;
 }
?>

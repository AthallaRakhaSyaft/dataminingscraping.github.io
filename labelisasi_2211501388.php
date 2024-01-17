<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tahap Labelisasi Data</title>
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
include 'Koneksi_2211501388.php';

$sql = "SELECT * FROM galert_data_2211501388 where length(galert_id)!=0";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "Data Tidak Ditemukan";
}else{
    ?>
    <table class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
        <td colspan="3"<strong>Daftar Kategori</strong></td>
    </tr>
    <tr bgcolor="#CCCCCC">
    <th>No.</th>
    <th>Title</th>
    <th>Nama Kategori</th>
    </tr>
    </thead>
    <?php 
    $i=1;
    while($d = mysqli_fetch_array($result)) {
        $id = $d['galert_id'];
        $title = $d['galert_title'];

        $stoplist = array("Google","Alert"," ","-");
        $rem_stopword=explode(" ",$title);
        $str_data=array();
        foreach($rem_stopword as $value){
            if(!in_array($value, $stoplist)){
                $str_data[] = "".$value;
            }
        }
        $kategori = implode(" ", $str_data);
    ?>

        <tr bgcolor="#FFFFFF">
            <td><?php echo $i; ?></td>
            <td><?php echo $title; ?></td>
            <td><?php echo $kategori; ?></td>
        </tr>
        <?php 

        $sql = "SELECT * FROM kategori_2211501388 where nm_kategori='$kategori'";
        $result1 = $conn->query($sql);

        if ($result1->num_rows == 0) {
            $q = "INSERT INTO kategori_2211501388(nm_kategori)
                    VALUES('$kategori')";

            $result1 = mysqli_query($conn,$q);
        }

        $sql = "SELECT id_kategori FROM kategori_2211501388 where nm_kategori='$kategori'";
        $result2 = $conn->query($sql);

        $d = mysqli_fetch_row($result2);
        $id_kategori = $d[0];

        $sql = "SELECT * FROM galert_entry_2211501388 where feed_id='$id'";
        $result2 = $conn->query($sql);

        if ($result2->num_rows > 0) {
            $q = "UPDATE preprocessing_2211501388 set id_kategori='$id_kategori'
                        where entry_id in(SELECT entry_id FROM galert_entry_2211501388 where feed_id='$id')";

            $result2 = mysqli_query($conn,$q);
        }
    $i=$i+1;
    }

    if ($result2){
        echo '<strong>Berhasil!</strong> Tahap Labelisasi Data Berhasil';
    }else{
        echo '<strong>Gagal!</strong> Tahap Labelisasi Data Tidak Berhasil';
    }
}
?>
<br>
<br>
<?php

    $i=1;
    $sql = "SELECT * FROM preprocessing_2211501388 where length(entry_id)!=0";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        echo "Data Tidak Ditemukan";
    }else{
        ?>
        <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <td colspan="3"><strong>Daftar Labelisasi Data</strong></td>
        </tr>
        <tr bgcolor="#CCCCCC">
        <th>No.</th>
        <th>Data Bersih</th>
        <th>Nama Kategori</th>
        </tr>
        </thead>
        <?php
        while($d = mysqli_fetch_array($result)){
            $data_bersih = $d['data_bersih'];
            $id_kategori = $d['id_kategori'];

            $sql = "SELECT nm_kategori FROM kategori_2211501388 where id_kategori='$id_kategori'";
            $result2 = $conn->query($sql);

            $d = mysqli_fetch_row($result2);
            $nm_kategori = $d[0];

            ?>
                <tr bgcolor="#FFFFFF">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data_bersih; ?></td>
                    <td><?php echo $nm_kategori; ?></td>
                </tr>

            <?php
            $i=$i+1;
            }
}
?>
<br>
<br>
</body>
</html>
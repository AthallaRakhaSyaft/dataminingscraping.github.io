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
      <td colspaj="3">
      <button onclick="window.location.href = 'FormLoadFile_2211501388.php';">Kembali Ke Form Input Link</button>
      </td>
</table>
    
<?php 
require_once "Koneksi_2211501388.php";

$sql = "SELECT data_bersih,id_actual,nm_kategori FROM classify_2211501388 a,kategori_2211501388 b WHERE a.id_predicted=b.id_kategori";
$result = $conn->query($sql);
?>

<table class="table table-bordered table-striped table-hover">
<thead>
    <br><br><tr></tr>
<tr>
    <td colspan="5"><strong>Menentukan Kategori Aktual</strong></td>
</tr>
<tr bgcolor="#CCCCCC">
<th>No.</th>
<th>Data Bersih</th>
<th>Prediksi Kategori</th>
<th>Aktual Kategori</th>
</tr>
</thead>
    <form action="" method="post">
    <?php 
    $i=1;
    while($d = mysqli_fetch_array($result))
    {
    ?>
        <tr bgcolor="#FFFFFF">
            <td><?php echo $i; ?></td>
            <td><input type='text' name="data_bersih[]" value="<?php echo $d[0]; ?>" style="width:800px; border :0px>"</td>
            <td><?php echo $d[2]; ?></td>
            <td>
                <?php $aktual=$d[1]; ?>
                <select class="form-control" name="aktual[]" id="aktual[]">
                <option value="">Pilih Aktual Kategori</option>
                <option value="1" <?=($aktual=='1')?'selected="selected"':''?>>BBC</option>
                <option value="2" <?=($aktual=='2')?'selected="selected"':''?>>cnn</option>
                <option value="3" <?=($aktual=='3')?'selected="selected"':''?>>detik</option>
                </selected>
            </td>
        </tr>
    <?php 
        $i=$i+1;
    }
    ?>
</table>
    <input type="submit" name="simpan" value="Simpan Data">
    </from>

<?php 
    $i=$i-1;
    if(isset($_POST['simpan'])) {
            for($j=0;$j<$i;$j++){
                $data_bersih=$_POST['data_bersih'][$j];
                $a=$_POST['aktual'][$j];

                $sql = "SELECT * FROM classify_2211501388 WHERE data_bersih='$data_bersih'";
                $result1 = $conn->query($sql);
                if ($result1->num_rows > 0) {
                    $q="UPDATE classify_2211501388 set id_actual='$a' where data_bersih='$data_bersih'";
                    $result2 = mysqli_query($conn,$q);
                }
            }
?>
    <script>
        alert("Proses Simpan Data Selesai");
        window.history.go(-2);
    </script>
<?php 
    } 
?>

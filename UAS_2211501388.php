<!DOCTYPE html>
<html>
<head>
    <title>Tahap Klasifikasi Data Dengan Algoritma Naive Bayes</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
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

        $sql = "SELECT COUNT(*) FROM classify_2211501388 where id_actual=id_predicted";
        $query = $conn->query($sql);
        $d = mysqli_fetch_array($query);
        $TP = $d[0];
        $sql1 = "SELECT COUNT(*) FROM classify_2211501388";
        $query1 = $conn->query($sql1);
        $d1 = mysqli_fetch_array($query1);
        $jmlDok = $d1[0];  
        $accuracy = ($TP/$jmlDok)*100;
        

        $sql2 = "SELECT COUNT(*) FROM classify_2211501388 where id_predicted=id_actual and id_predicted='1'";
        $query2 = $conn->query($sql2);
        $a = mysqli_fetch_array($query2);
        $TP1 = $a[0];
        $sql3 = "SELECT COUNT(*) FROM classify_2211501388 where id_predicted!=id_actual and id_predicted='1'";
        $query3 = $conn->query($sql3);
        $a = mysqli_fetch_array($query3);
        $FP1 = $a[0];

        $sql2 = "SELECT COUNT(*) FROM classify_2211501388 where id_predicted=id_actual and id_predicted='2'";
        $query2 = $conn->query($sql2);
        $a = mysqli_fetch_array($query2);
        $TP2 = $a[0];
        $sql3 = "SELECT COUNT(*) FROM classify_2211501388 where id_predicted!=id_actual and id_predicted='2'";
        $query3 = $conn->query($sql3);
        $a = mysqli_fetch_array($query3);
        $FP2 = $a[0];

        $sql2 = "SELECT COUNT(*) FROM classify_2211501388 where id_predicted=id_actual and id_predicted='3'";
        $query2 = $conn->query($sql2);
        $a = mysqli_fetch_array($query2);
        $TP3 = $a[0];
        $sql3 = "SELECT COUNT(*) FROM classify_2211501388 where id_predicted!=id_actual and id_predicted='3'";
        $query3 = $conn->query($sql3);
        $a = mysqli_fetch_array($query3);
        $FP3 = $a[0];

        $sql4 = "SELECT COUNT(*) FROM kategori_2211501388";
        $query4 = $conn->query($sql4);
        $b = mysqli_fetch_array($query4);
        $jmlKelas = $b[0];

        $precision1 = $TP1/($TP1+$FP1);
        $precision2 = $TP2/($TP2+$FP2);
        $precision3 = $TP3/($TP3+$FP3);

        $hasilPrecision[] = $precision1;
        $hasilPrecision[] = $precision2;
        $hasilPrecision[] = $precision3;

        $precision = (($precision1+$precision2+$precision3)/$jmlKelas)*100;
        
        $TPPrecision[]=$TP1;
        $TPPrecision[]=$TP2;
        $TPPrecision[]=$TP3;
        $FPPrecision[]=$FP1;
        $FPPrecision[]=$FP2;
        $FPPrecision[]=$FP3;

        $sql2 = "SELECT COUNT(*) FROM classify_2211501388 where id_predicted=id_actual and id_predicted='1'";
        $query2 = $conn->query($sql2);
        $a = mysqli_fetch_array($query2);
        $TP1 = $a[0];
        $sql3 = "SELECT COUNT(*) FROM classify_2211501388 where id_actual!=id_predicted and id_actual='1'";
        $query3 = $conn->query($sql3);
        $a = mysqli_fetch_array($query3);
        $FN1 = $a[0];

        $sql2 = "SELECT COUNT(*) FROM classify_2211501388 where id_predicted=id_actual and id_predicted='2'";
        $query2 = $conn->query($sql2);
        $a = mysqli_fetch_array($query2);
        $TP2 = $a[0];
        $sql3 = "SELECT COUNT(*) FROM classify_2211501388 where id_actual!=id_predicted and id_actual='2'";
        $query3 = $conn->query($sql3);
        $a = mysqli_fetch_array($query3);
        $FN2 = $a[0];

        $sql2 = "SELECT COUNT(*) FROM classify_2211501388 where id_predicted=id_actual and id_predicted='3'";
        $query2 = $conn->query($sql2);
        $a = mysqli_fetch_array($query2);
        $TP3 = $a[0];
        $sql3 = "SELECT COUNT(*) FROM classify_2211501388 where id_actual!=id_predicted and id_actual='3'";
        $query3 = $conn->query($sql3);
        $a = mysqli_fetch_array($query3);
        $FN3 = $a[0];

        $recall1 = $TP1/($TP1+$FN1);
        $recall2 = $TP2/($TP2+$FN2);
        $recall3 = $TP3/($TP3+$FN3);
        $HasilRecall[] = $recall1;
        $HasilRecall[] = $recall2;
        $HasilRecall[] = $recall3;

        $recall = (($recall1+$recall2+$recall3)/$jmlKelas)*100;

        $TPRecall[] = $TP1;
        $TPRecall[] = $TP2;
        $TPRecall[] = $TP3;
        $FNRecall[] = $FN1;
        $FNRecall[] = $FN2;
        $FNRecall[] = $FN3;
    ?>
<?php
$sql5 = "SELECT * FROM kategori_2211501388 order by id_kategori";
$query5 = $conn->query($sql5);
?>
<table class="table table-bordered table-striped table-hover">
<thead>
<br><br>
<tr>
    <td>==> Nilai Akurasi Yang Di Dapat : <?php echo $accuracy ?></td>
</tr>
<tr>
    <td colspan="5"><strong>Menghitung Precision</strong></td>
    </tr>
    <tr bgcolor="#CCCCCC">
    <th>No.</th>
    <th>Kategori</th>
    <th>True Positive</th>
    <th>False Positive</th>
    <th>Precision</th>
    </tr>
    </thead>
        <?php

        $i=0;
        while($d = mysqli_fetch_array($query5))
        {
            ?>
            <tr bgcolor="#FFFFFF">
            <td><?php echo $d[0]; ?></td>
            <td><?php echo $d[1]; ?></td>
            <td><?php echo $TPPrecision[$i] ?></td>
            <td><?php echo $FPPrecision[$i] ?></td>
            <td><?php echo $TPPrecision[$i].'/'."($TPPrecision[$i] + $FPPrecision[$i]) = $hasilPrecision[$i]" ?></td>
            </tr>
            <?php
            $i=$i+1;
        }
        ?>
        <tr>
        <td>==>Nilai Precision Yang Di Dapat :<?php echo $precision ?></td>
        </tr>
        </table>
        <br>
        <br>

<?php
$sql5 = "SELECT * FROM kategori_2211501388 order by id_kategori";
$query5 = $conn->query($sql5);
?>
<table class="table table-bordered table-striped table-hover">
<thead>
<br><br>
<tr>
    <td colspan="5"><strong>Menghitung Recall</strong></td>
    </tr>
    <tr bgcolor="#CCCCCC">
    <th>No.</th>
    <th>Kategori</th>
    <th>True Positive</th>
    <th>False Negative</th>
    <th>Recall</th>
    </tr>
    </thead>
        <?php
        $i=0;
        while($d = mysqli_fetch_array($query5))
        {
            ?>
            <tr bgcolor="#FFFFFF">
            <td><?php echo $d[0]; ?></td>
            <td><?php echo $d[1]; ?></td>
            <td><?php echo $TPRecall[$i] ?></td>
            <td><?php echo $FNRecall[$i] ?></td>
            <td><?php echo $TPRecall[$i].'/'."($TPRecall[$i] + $FNRecall[$i]) = $HasilRecall[$i]" ?></td>
            </tr>
            <?php
            $i=$i+1;
        }
        ?>
        <tr>
        <td>==>Nilai Recall Yang Di Dapat :<?php echo $recall ?></td>
        </tr>
        </table>
</body>
</html>
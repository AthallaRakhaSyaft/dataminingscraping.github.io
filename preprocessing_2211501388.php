<!DOCTYPE html>
<center><h1>2211501388 ATHALLA RAKHA SYAFA'AT</h1></center>

<html>
<h3><a href="FormLoadFile_2211501388.php">Kembali Ke Form Input Link</a></h3>
<br>
</html>

<?php
include 'Koneksi_2211501388.php';
include "stopword_2211501388.php";

require_once __DIR__ . '/sastrawi/vendor/autoload.php';

$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
$stemmer  = $stemmerFactory->createStemmer();

echo "<br>";

$sql = "SELECT kata_tbaku,concat(kata_baku,' ') kata_baku FROM slangword_2211501388";
$stmt = $conn->prepare($sql);
$stmt->execute();
$resultSet = $stmt->get_result();
$result = $resultSet->fetch_all();
$arr_slang=array();
foreach($result as $k=>$v) {
    $arr_slang[$v[0]]=$v[1];
}

$sql = "SELECT * FROM galert_entry_2211501388 where length(entry_id)!=0";
$result = $conn->query($sql);
if ($result->num_rows == 0 ) {
    echo "Data Tidak Ditemukan";
}else{
    ?>
    <table border="1" cellpadding="1" cellspacing="1" bgcolor="#999999">
    <tr bgcolor="#CCCCCC">
    <th>ID</th>
    <th>Content</th>
    <th>Case Folding</th>
    <th>Hapus Simbol</th>
    <th>Filter Slang Word</th>
    <th>Filter Stop Word</th>
    <th>Stimming</th>
    <th>Tokenisasi</th>
    </tr>
    <?php 
    while($d = mysqli_fetch_array($result)){
        $id = $d['entry_id'];
        $content = $d['entry_content'];

        //1 Case Folding
            //echo strtoupper($content);
            //echo startlower($content);
            $cf = strtolower($content);


        //2 Penghapusan Simbol-Simbol (Symbol Removal)
            $simbol = preg_replace("/[^a-zA-Z\\s]/", "", $cf);

        //3 Konversi Slangword
            $rem_slang=explode(" ",$simbol);
            $slangword=str_replace(array_keys($arr_slang), $arr_slang, $simbol);


        //4 Stopword Removal
            $rem_stopword=explode(" ",$slangword);
            $str_data=array();
            foreach($rem_stopword as $value){
                if(!in_array($value, $stopword_2211501388)){
                    $str_data[] = "".$value;
                }
            }
            $stopword = implode(" ", $str_data);


        //5 Stemming
            $query1 = implode(' ', (array)$stopword);
            $stemming   = $stemmer->stem($query1);


        //6 Tokenisasi
            $tokenisasi = preg_split("/[\s,.:]+/", $stemming);
            $tokenisasi=implode(", ",$tokenisasi);
    ?>

        <tr bgcolor="#FFFFFF">
            <td><?php echo $id; ?></td>
            <td><?php echo $content; ?></td>
            <td><?php echo $cf; ?></td>
            <td><?php echo $simbol; ?></td>
            <td><?php echo $slangword; ?></td>
            <td><?php echo $stopword; ?></td>
            <td><?php echo $stemming; ?></td>
            <td><?php echo $tokenisasi; ?></td>
        </tr>

    <?php 

            $sql = "SELECT * FROM preprocessing_2211501388 where entry_id='$id'";
            $result1 = $conn->query($sql);

            if ($result1->num_rows == 0) {
                //save to database
                $q = "INSERT INTO preprocessing_2211501388(entry_id,p_cf,p_simbol,p_tokenisasi,p_sword,p_stopword,p_stemming,data_bersih)
                        VALUES('$id','$cf','$simbol','$tokenisasi','$slangword','$stopword','$stemming','$stemming')";

                $result1 = mysqli_query($conn,$q);
            }else {

                            $q = "UPDATE preprocessing_2211501388 set entry_id='$id', p_cf='$cf', p_simbol='$simbol', p_tokenisasi='$tokenisasi', p_sword='$slangword',
                                        p_stopword='$stopword', p_stemming='$stemming', data_bersih='$stemming'
                                        where entry_id='$id'";

                $result1 = mysqli_query($conn,$q);
            }
        }
    ?>
        </table>

    <?php
        if ($result1){
            echo '<h4>Preprocessing Data Berhasil</h4>';
        }else{
            echo '<h2>Gagal Melakukan Preprocessing Data</h2>';
        }
}
?>
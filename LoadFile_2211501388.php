<!DOCTYPE html>
<center><h1>2211501388 ATHALLA RAKHA SYAFA'AT</h1></center>

<html>
<h3><a href="FormLoadFile_2211501388.php">kembali ke Form Input Link</a></h3>
<br>
</html>

<?php
include 'Koneksi_2211501388.php';
include 'XML2Array_2211501388.php';
 
//Perintah program baris 14 berfungsi untuk menampung inputan link dari user ke dalam variabel link
$link = $_GET['link'];

//Perintah program baris 17 berfungsi untuk membaca dan mengurai file XML
$xml=simplexml_load_file($link);

//Perintah program baris 20 sampai 25 berfungsi cek kondisi apakah file xml dapat berhasil dibaca/dibuka atau tidak
if( !$xml) //using simplexml_load_file function to load xml file
{
echo 'load XML failed ! ';
}
else
{
//Perintah program baris 27 berfungsi mengkonversi dokumen XML pada variabel xml menjadi elemen array
$array = XML2Array($xml);

//memberikan nilai 0 pada isi dari variabel tersebut
$a=0;

//save to tabel galert_data_2211501388
foreach( $array as $key => $value) {
    $id = $array['id'];
    $title = $array['title'];
    $link = $array['link'];
    $update = $array['updated'];
    
    //select to database
    $sql = "SELECT * FROM galert_data_2211501388 where galert_id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "";
    }else{
        //save to database
        $q = "INSERT INTO galert_data_2211501388(galert_id,galert_title,galert_link,galert_update)
        VALUES('$id','$title','$link','$update')";
        $result = mysqli_query($conn,$q);

        //save to tabel galert_entry_2211501388
        foreach( $xml as $record )
        {
            $id2 = $record->id;
            $title = $record->title;
            $link = $record->link;
            $published = $record->published;
            $update = $record->update;
            $content = $record->content;
            $author = $record->author;

            //select to database
            $sql = "SELECT * FROM galert_entry_2211501388 where entry_id='$id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "";
            }else{
                //save to database
                $q = "INSERT INTO galert_entry_2211501388(entry_id,entry_title,entry_link,entry_published,
                entry_updated,entry_content,entry_author,feed_id)
                VALUES('$id2','$title','$link','$published','$update','$content','$author','$id')";
                
                $result = mysqli_query($conn,$q);
            }
        }
    }
}

//Variabel tersebut untuk memberikan instruksi jika benar maka Penyimpanan Data Berhasil
if ($result) {
    echo '<h4>Penyimpanan Data Berhasil </h4>';

//Variabel tersebut untuk memberikan instruksi jika salah maka Gagal Melakukan Penyimpanan Data
}else
    echo '<h2>Gagal Melakukan Penyimpanan Data</h2>';
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
    body
        {
            font-family:verdana, Geneva, sans-serif;
        }
</style>
</head>
<body>
<table cellpadding="1" cellspacing="1" bgcolor="#999999">
        <tr bgcolor="#CCCCCC">
            <th>No</th>
            <th>ID</th>
            <th>Title</th>
            <th>Link</th>
            <th>Publisher</th>
            <th>Update</th>
            <th>Content</th>
            <th>Author</th>
        </tr>
        <?php 

        $i=1;
            foreach($xml as $r)
                {
        ?>
        <tr bgcolor="#FFFFFF">
            <td><?php echo $i++;?></td>
            <td><?php echo $r->id;?></td>
            <td><?php echo $r->title;?></td>
            <td><?php echo $r->link;?></td>
            <td><?php echo $r->published;?></td>
            <td><?php echo $r->update;?></td>
            <td><?php echo $r->content;?></td>
            <td><?php echo $r->author;?></td>
        </tr>
        <?php 
               }
        ?>
        </table><br/>
        </body>
        </html>


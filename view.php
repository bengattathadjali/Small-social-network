<?php 
	include 'db.php';

if (isset($_GET['FileNo'])) {
    $fileid = $_GET['FileNo'];
    try {
      
      $sql = $bdd->prepare('SELECT * FROM publication WHERE name_file =?');
        $sql -> bindParam(1,$fileid);

        $sql->execute();
        
        while ($row = $sql->fetch()) {
            $filename = $row['name_file'];
            $mimetype = $row['mime_file'];
            $filedata = $row['data'];
           	header("Content-length: strlen($filedata)");
            header("Content-type: $mimetype");
            header("Content-disposition: download; filename=$filename"); //disposition of download forces a download
            echo $filedata;
        } //of While
    } //try
    catch (PDOException $e) {
        $error = '<br>Database ERROR fetching requested file.';
        echo $error;
        die();    
    } //catch
} //isset
?>
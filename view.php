<?php 
	require_once ('db.php');



        $id = isset($_GET['name_file'])? $_GET['name_file'] : "";

        $stat = $bdd->prepare('SELECT * FROM publication WHERE name_file=:name_file');
        $stat->bindParam(':name_file',$id);
        $stat->execute();
        $row = $stat->fetch();
        header('Content-Type:'.$row['mime_file']);
        echo $row['data_file'];
?>
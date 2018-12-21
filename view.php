<?php 
	require_once ('db.php');



        $id = isset($_GET['id_publication'])? $_GET['id_publication'] : "";

        $stat = $bdd->prepare('SELECT * FROM publication WHERE id_publication=:id_publication');
        $stat->bindParam(':id_publication',$id);
        $stat->execute();
        $row = $stat->fetch();
        header('Content-Type:'.$row['mime_file']);
        echo $row['data_file'];
?>
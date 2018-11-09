<?php 
	require_once 'db.php';
	$id = htmlspecialchars($_GET['id']);

	$rq =$bdd->prepare("DELETE FROM publication WHERE id_publication=:id_publication");
	$rq->bindParam(':id_publication',$id);
	$rq->execute();
	header('Location:filActuEns.php');
	?>
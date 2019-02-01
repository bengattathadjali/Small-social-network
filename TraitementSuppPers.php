<?php
	require_once 'db.php';
	$matricule_personnel = $_GET['matricule_personnel'];
	
	$rq = $bdd->prepare( "DELETE FROM publication WHERE matricule_personnel =:matricule_personnel" );
            $rq->bindParam(':matricule_personnel', $matricule_personnel);
            $rq->execute();

	$sq = $bdd->prepare( "DELETE FROM dirige WHERE matricule_personnel =:matricule_personnel" );
            $sq->bindParam(':matricule_personnel', $matricule_personnel);
            $sq->execute();    

	$stmt = $bdd->prepare("DELETE FROM personnel WHERE matricule_personnel =:matricule_personnel");
            $stmt->bindParam(':matricule_personnel', $matricule_personnel);
            $stmt->execute(); 


	header('Location:AffichagePers.php');

?>
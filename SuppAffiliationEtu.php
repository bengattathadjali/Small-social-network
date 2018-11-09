<?php
	require_once 'db.php';
	$matricule = $_GET['matricule'];
  
	$rq = $bdd->prepare( "DELETE FROM etudiant WHERE matricule =:matricule ");
            $rq->bindParam(':matricule', $matricule);
            
            $rq->execute();

	

            
	 header('Location:AffiliationEtudiant.php');

?>
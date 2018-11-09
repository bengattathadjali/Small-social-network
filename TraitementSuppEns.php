<?php
	require_once 'db.php';
	$matricule_enseignant = $_GET['matricule_enseignant'];
    

	$rq = $bdd->prepare( "DELETE FROM publication WHERE matricule_enseignant =:matricule_enseignant" );
            $rq->bindParam(':matricule_enseignant', $matricule_enseignant);
            $rq->execute();

	

    $sq = $bdd->prepare( "DELETE FROM enseigne WHERE matricule_enseignant =:matricule_enseignant" );
            $sq->bindParam(':matricule_enseignant', $matricule_enseignant);
            $sq->execute();

    $stmt = $bdd->prepare( "DELETE FROM enseignant WHERE matricule_enseignant =:matricule_enseignant" );
            $stmt->bindParam(':matricule_enseignant', $matricule_enseignant);
            $stmt->execute();
            
	header('Location:AffichageEns.php');

?>
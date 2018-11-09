<?php
	require_once 'db.php';
	$matricule = $_GET['matricule'];

	$stmt = $bdd->prepare( "DELETE FROM etudiant WHERE matricule =:matricule" );
            $stmt->bindParam(':matricule', $matricule);
            $stmt->execute();

	header('Location:AffichageEtu.php');

?>
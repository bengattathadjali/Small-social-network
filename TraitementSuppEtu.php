<?php
	require_once 'db.php';
	$email = $_GET['email'];

	$stmt = $bdd->prepare( "DELETE FROM etudiant WHERE email =:email" );
            $stmt->bindParam(':email', $email);
            $stmt->execute();

	header('Location:AffichageEtu.php');

?>
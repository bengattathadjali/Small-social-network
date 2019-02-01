<?php
	require_once 'db.php';
	$matricule_enseignant = $_GET['matricule_enseignant'];
    $promo = $_GET['promo'];
    
	$rq = $bdd->prepare( "DELETE FROM enseigne WHERE matricule_enseignant =:matricule_enseignant AND id_promo =:id_promo" );
            $rq->bindParam(':matricule_enseignant', $matricule_enseignant);
            $rq->bindParam(':id_promo', $promo);
            $rq->execute();

	

            
	 header('Location:AffiliationEnseignant.php');

?>
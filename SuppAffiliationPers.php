<?php
	require_once 'db.php';
	$matricule_personnel = $_GET['matricule_personnel'];
    $promo = $_GET['promo'];
    echo $promo;
	$rq = $bdd->prepare( "DELETE FROM dirige WHERE matricule_personnel =:matricule_personnel AND id_promo =:id_promo" );
            $rq->bindParam(':matricule_personnel', $matricule_personnel);
            $rq->bindParam(':id_promo', $promo);
            $rq->execute();

	

            
	 header('Location:AffiliationPersonnel.php');

?>
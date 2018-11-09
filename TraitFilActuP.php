<?php 
	session_start();
	require_once 'db.php';
	

	date_default_timezone_set('Africa/Algiers');
	$datePublication = date("Y-m-d : H:i:s");
	
	$contenu = htmlspecialchars($_POST['contenu']);
	$matricule= $_SESSION['matricule'];
	
	$id_promo = "2";

		if($_SESSION['statut']==='Enseignant'){
			$stmt = $bdd->prepare("INSERT INTO publication (datePublication, contenu,matricule_Enseignant	, id_promo) VALUES (:datePublication, :contenu,:matricule_Enseignant, :id_promo)");
								$stmt->bindParam(':datePublication', $datePublication);
								$stmt->bindParam(':contenu', $contenu);
							
								$stmt->bindParam(':matricule_Enseignant', $matricule);
								$stmt->bindParam(':id_promo', $id_promo);
								$stmt->execute();

							}
		if($_SESSION['statut']==='Personnel'){
			$stmt = $bdd->prepare("INSERT INTO publication (datePublication, contenu,matricule, id_promo) VALUES (:datePublication, :contenu,:matricule, :id_promo)");
								$stmt->bindParam(':datePublication', $datePublication);
								$stmt->bindParam(':contenu', $contenu);
							
								$stmt->bindParam(':matricule', $matricule);
								$stmt->bindParam(':id_promo', $id_promo);
								$stmt->execute();
		}				

?>
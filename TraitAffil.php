<?php
	session_start();
	require_once 'db.php';

	$matricule = trim(htmlspecialchars($_POST['matricule']));
	$statut  = $_POST['statut'];
	$id_promo = trim(htmlspecialchars($_POST['promo']));

	$promo_exisist = $bdd->prepare('SELECT * FROM promo WHERE id_promo=:id_promo');
	$promo_exisist->execute(array(
			'id_promo'=>$id_promo
					));
	if($promo_exisist->rowCount()===1){

		if($statut==='Enseignant'){
			$matricule_enseignant=$matricule;
			$matricule_exsist = $bdd->prepare('SELECT * FROM enseignant WHERE  matricule_enseignant=:matricule_enseignant');
			$matricule_exsist->execute(array(
			'matricule_enseignant'=>$matricule_enseignant
					));
						if($matricule_exsist->rowCount()!=1){
							header('Location:admin.php');	
							$_SESSION['msg_2']='Ce matricule n\'existe pas';
							
						}
						else{
							$stmt = $bdd->prepare("INSERT INTO enseigne (matricule_enseignant, id_promo) VALUES (:matricule_enseignant, :id_promo)");
							$stmt->bindParam(':matricule_enseignant', $matricule_enseignant);
							$stmt->bindParam(':id_promo', $id_promo);
							$stmt->execute();
							header('Location:admin.php');	
							$_SESSION['msg_2']='Affiliation ajoutée';
							
							
						}
		}
		if($statut==='Personnel'){
			$matricule_personnel=$matricule;
			$matricule_exsist = $bdd->prepare('SELECT * FROM personnel WHERE matricule_personnel=:matricule_personnel');
			$matricule_exsist->execute(array(
			'matricule_personnel'=>$matricule_personnel
					));
						if($matricule_exsist->rowCount()!=1){
							header('Location:admin.php');	
							$_SESSION['msg_2']='Ce matricule n\'existe pas';
								
						}
						else{
							$stmt = $bdd->prepare("INSERT INTO dirige (matricule_personnel, id_promo) VALUES (:matricule_personnel, :id_promo)");
							$stmt->bindParam(':matricule_personnel', $matricule_personnel);
							$stmt->bindParam(':id_promo', $id_promo);
							$stmt->execute();
							header('Location:admin.php');
							$_SESSION['msg_2']='Affiliation ajoutée';
							
						}
		}

		}
		else{
			header('Location:admin.php');
			$_SESSION['msg_2']='Ce code Promo n\'existe pas';
			
		}



?>
<?php 
	session_start();
	require_once 'db.php';
	//recupération des données
	
	
	$nom = trim(htmlspecialchars($_POST['nom']));
	$nom = strtoupper($nom);
	$prenom = trim(htmlspecialchars($_POST['prenom']));
	$prenom = strtoupper($prenom);
	$matricule = trim(htmlspecialchars($_POST['matricule']));
	$statut  = $_POST['statut'];
	$id_promo = trim(htmlspecialchars($_POST['promo']));


		if($statut ==='Etudiant'){
			$matricule_exsist = $bdd->prepare('SELECT * FROM etudiant WHERE matricule=:matricule');
			$matricule_exsist->execute(array(
			'matricule'=>$matricule
					));
						if($matricule_exsist->rowCount()===1){
							header('Location:admin.php');
							$_SESSION['error_2']='Ce matricule existe deja';
						}
						else{
					$rq = $bdd->prepare('SELECT * FROM etudiant WHERE nom =:nom AND prenom=:prenom AND matricule=:matricule ');
					$rq ->execute(array(
					'nom'=>$nom,
					'prenom'=>$prenom,
					'matricule'=>$matricule
										));
				
				
						$stmt = $bdd->prepare("INSERT INTO etudiant (nom, prenom, matricule, id_promo) VALUES (:nom, :prenom, :matricule, :id_promo)");
						$stmt->bindParam(':nom', $nom);
						$stmt->bindParam(':prenom', $prenom);
						$stmt->bindParam(':matricule', $matricule);
						$stmt->bindParam(':id_promo', $id_promo);
						$stmt->execute();
						header('Location:admin.php');
						$_SESSION['error_2']='Etudiant Ajouté';
						
						
					
				}


		}
		if($_POST['statut']==='Enseignant'){
			$matricule_enseignant=$matricule;
			$matricule_exsist = $bdd->prepare('SELECT * FROM enseignant WHERE matricule_enseignant=:matricule_enseignant');
			$matricule_exsist->execute(array(
			'matricule_enseignant'=>$matricule_enseignant
					));
						if($matricule_exsist->rowCount()===1){
							header('Location:admin.php');
							$_SESSION['error_2']='Ce matricule existe deja';
								
						}
						else{
						$rq = $bdd->prepare('SELECT * FROM enseignant WHERE nom =:nom AND prenom=:prenom AND matricule_enseignant=:matricule_enseignant ');
						$rq ->execute(array(
						'nom'=>$nom,
						'prenom'=>$prenom,
						'matricule_enseignant'=>$matricule_enseignant
											));
						
						
							$stmt = $bdd->prepare("INSERT INTO enseignant (nom, prenom, matricule_enseignant) VALUES (:nom, :prenom, :matricule_enseignant)");
							$stmt->bindParam(':nom', $nom);
							$stmt->bindParam(':prenom', $prenom);
							$stmt->bindParam(':matricule_enseignant', $matricule_enseignant);
							
							$stmt->execute();
							header('Location:admin.php');
							$_SESSION['error_2']='Enseignant Ajouté';
							
						
				}

		}
		if($_POST['statut']==='Personnel'){
			$matricule_personnel=$matricule;
				$matricule_exsist = $bdd->prepare('SELECT * FROM personnel WHERE matricule_personnel=:matricule_personnel');
			$matricule_exsist->execute(array(
			'matricule_personnel'=>$matricule_personnel
					));
						if($matricule_exsist->rowCount()===1){
							header('Location:admin.php');	
							$_SESSION['error_2']='Ce matricule existe deja';
							
						}
						else{
						$rq = $bdd->prepare('SELECT * FROM personnel WHERE nom =:nom AND prenom=:prenom AND matricule_personnel=:matricule_personnel ');
						$rq ->execute(array(
						'nom'=>$nom,
						'prenom'=>$prenom,
						'matricule_personnel'=>$matricule_personnel
											));
						
						
							$stmt = $bdd->prepare("INSERT INTO personnel (nom, prenom, matricule_personnel) VALUES (:nom, :prenom, :matricule_personnel)");
							$stmt->bindParam(':nom', $nom);
							$stmt->bindParam(':prenom', $prenom);
							$stmt->bindParam(':matricule_personnel', $matricule_personnel);
							
							$stmt->execute();
							header('Location:admin.php');
							$_SESSION['error_2']='Personnel Ajouté';
							
						
				}
		}
?>
<?php 
	session_start();
	$_SESSION['error']='';
	require_once 'db.php';
	

	$nom = trim(htmlspecialchars($_POST['nom']));
	$nom = strtoupper($nom);
	$prenom = trim(htmlspecialchars($_POST['prenom']));
	$prenom = strtoupper($prenom);
	$email = trim(htmlspecialchars($_POST['email']));
	$motDePasse = trim(htmlspecialchars($_POST['motDePasse']));
	$matricule = trim(htmlspecialchars($_POST['matricule']));
	$statut  = $_POST['statut'];
	//controller le mot de passe
	$uppercase = preg_match('@[A-Z]@', $motDePasse); 
	$lowercase = preg_match('@[a-z]@', $motDePasse);
	$number    = preg_match('@[0-9]@', $motDePasse);

		if(!$uppercase || !$lowercase || !$number || strlen($motDePasse) < 8) {
				//renvoie message d'erreur
				header('Location:inscription.php');
				$_SESSION['error']='le mot de passe doit contenir 8 caracteres une Maj et miniscule et un nombre';
			}
		else{
			if((!empty($_POST['nom'])) AND (!empty($_POST['prenom'])) AND (!empty($_POST['matricule'])) AND (!empty($_POST['statut'])) ){
				$motDePasse = md5(htmlspecialchars($_POST['motDePasse']));
					if($statut === 'Etudiant'){
						$email_exsist = $bdd->prepare('SELECT * FROM etudiant WHERE email=:email');
						$email_exsist->execute(array(
						'email'=>$email
					));
						if($email_exsist->rowCount()===1){
							header('Location:inscription.php');
							$_SESSION['error']='L\'email existe deja';	
						}
						else{
							//confirmer l'existance de l'etudiant
									$rq = $bdd->prepare('SELECT * FROM etudiant WHERE nom =:nom AND prenom=:prenom AND matricule=:matricule');
									$rq ->execute(array(
										'nom'=>$nom,
										'prenom'=>$prenom,
										'matricule'=>$matricule
									));

										if($rq->rowCount()===1){
											$req = $bdd->prepare('SELECT * FROM etudiant WHERE nom =:nom AND prenom=:prenom AND matricule=:matricule AND email is null AND motDePasse is null');
											$req ->execute(array(
												'nom'=>$nom,
												'prenom'=>$prenom,
												'matricule'=>$matricule
											));
										if($req->rowCount()==1){
											//nouveau etudiant
											
											
											
											$sql  = "UPDATE etudiant SET email=:email, motDePasse=:motDePasse WHERE matricule=:matricule";
											$stmt = $bdd->prepare($sql);
											$stmt->bindValue(":email",$email,PDO::PARAM_STR);
											$stmt->bindValue(":motDePasse",$motDePasse,PDO::PARAM_STR);
											$stmt->bindValue(":matricule",$matricule,PDO::PARAM_STR);
											
											$stmt->execute();
											
											header('Location:inscription.php');
											$_SESSION['error']='Vérifier votre boite email';
											
												
									
								}
								else{
									header('Location:inscription.php');
									$_SESSION['error']='Vous etes deja inscrit';
											}
										
							}
							
								else{
								header('Location:inscription.php');
								$_SESSION['error']='Champs incorrecte';
								}
						}
					}
					if($statut === 'Enseignant'){
						$matricule_enseignant=$matricule;
						$email_exsist = $bdd->prepare('SELECT * FROM enseignant WHERE email=:email');
						$email_exsist->execute(array(
						'email'=>$email
					));
						if($email_exsist->rowCount()===1){
							header('Location:inscription.php');
							$_SESSION['error']='L\'email existe deja';	
						}
						else{
							//confirmer l'existance du enseignant
									$rq = $bdd->prepare('SELECT * FROM enseignant WHERE nom =:nom AND prenom=:prenom AND matricule_enseignant=:matricule_enseignant');
									$rq ->execute(array(
										'nom'=>$nom,
										'prenom'=>$prenom,
										'matricule_enseignant'=>$matricule_enseignant
									));

										if($rq->rowCount()===1){
											$req = $bdd->prepare('SELECT * FROM enseignant WHERE nom =:nom AND prenom=:prenom AND matricule_enseignant=:matricule_enseignant AND email is null AND motDePasse is null');
											$req ->execute(array(
												'nom'=>$nom,
												'prenom'=>$prenom,
												'matricule_enseignant'=>$matricule_enseignant
											));
										if($req->rowCount()==1){
											//nouveau enseignant
											
											
											
											$sql  = "UPDATE enseignant SET email=:email, motDePasse=:motDePasse WHERE matricule_enseignant=:matricule_enseignant";
											$stmt = $bdd->prepare($sql);
											$stmt->bindValue(":email",$email,PDO::PARAM_STR);
											$stmt->bindValue(":motDePasse",$motDePasse,PDO::PARAM_STR);
											$stmt->bindValue(":matricule_enseignant",$matricule_enseignant,PDO::PARAM_STR);
											
											$stmt->execute();
											header('Location:inscription.php');
											$_SESSION['error']='Vérifier votre boite email';
											
									
								}
								else{
									header('Location:inscription.php');
									$_SESSION['error']='Vous etes deja inscrit';
											}
										
							}
							
								else{
								header('Location:inscription.php');
								$_SESSION['error']='Champs incorrecte';
								}
						}
					}
					if($statut === 'Personnel'){
						$matricule_personnel=$matricule;
						$email_exsist = $bdd->prepare('SELECT * FROM personnel WHERE email=:email');
						$email_exsist->execute(array(
						'email'=>$email
					));
						if($email_exsist->rowCount()===1){
							header('Location:inscription.php');
							$_SESSION['error']='L\'email existe deja';	
						}
						else{
							//confirmer l'existance du personnel
									$rq = $bdd->prepare('SELECT * FROM personnel WHERE nom =:nom AND prenom=:prenom AND matricule_personnel=:matricule_personnel');
									$rq ->execute(array(
										'nom'=>$nom,
										'prenom'=>$prenom,
										'matricule_personnel'=>$matricule_personnel
									));

										if($rq->rowCount()===1){
											$req = $bdd->prepare('SELECT * FROM personnel WHERE nom =:nom AND prenom=:prenom AND matricule_personnel=:matricule_personnel AND email is null AND motDePasse is null');
											$req ->execute(array(
												'nom'=>$nom,
												'prenom'=>$prenom,
												'matricule_personnel'=>$matricule_personnel
											));
										if($req->rowCount()==1){
											//nouveau personnel
										
											
											
											$sql  = "UPDATE personnel SET email=:email, motDePasse=:motDePasse WHERE matricule_personnel=:matricule_personnel";
											$stmt = $bdd->prepare($sql);
											$stmt->bindValue(":email",$email,PDO::PARAM_STR);
											$stmt->bindValue(":motDePasse",$motDePasse,PDO::PARAM_STR);
											$stmt->bindValue(":matricule_personnel",$matricule_personnel,PDO::PARAM_STR);
											
											$stmt->execute();
											header('Location:inscription.php');
											$_SESSION['error']='Vérifier votre boite email';
									
								}
								else{
									header('Location:inscription.php');
									$_SESSION['error']='Vous etes deja inscrit';
											}
										
							}
							
								else{
								header('Location:inscription.php');
								$_SESSION['error']='Champs incorrecte';
								}
						}
					}
			}
		}
	   

			?>
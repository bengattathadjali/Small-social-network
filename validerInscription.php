<?php 
	require_once 'db.php';
	include 'function.php';
	session_start();
	$_SESSION['error']='';
	
	

	$nom = trim(htmlspecialchars($_POST['nom']));
	$nom = strtoupper($nom);
	$prenom = trim(htmlspecialchars($_POST['prenom']));
	$prenom = strtoupper($prenom);
	$email = trim(htmlspecialchars($_POST['email']));
	$motDePasse = trim(htmlspecialchars($_POST['motDePasse']));
	// $matricule = trim(htmlspecialchars($_POST['matricule']));
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
			$token = 'AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn0123456789$';
			$token = str_shuffle($token);
			$token= substr($token,0,10);
			$EmailConfirm =0;
			$motDePasse = md5($motDePasse);
			$nom_utilisateur=ucfirst($nom)." ".ucfirst($prenom); 
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
									$stmt = $bdd->prepare("INSERT INTO etudiant (nom, prenom, email,motDePasse,EmailConfirm,token) 
															VALUES (:nom, :prenom, :email,:motDePasse,:EmailConfirm,:token)");
									$stmt->bindParam(':nom', $nom);
									$stmt->bindParam(':prenom', $prenom);
									$stmt->bindParam(':email', $email);
									$stmt->bindParam(':motDePasse',$motDePasse);
									$stmt->bindParam(':EmailConfirm', $EmailConfirm);
									$stmt->bindParam(':token', $token);

									if($stmt->execute()){
										
										sendmail($email,$nom_utilisateur,$token,$statut);
										header('Location:inscription.php');
										$_SESSION['error']='Vérifier votre boite';
									}
									else{
										header('Location:inscription.php');
									    $_SESSION['error']='Une erreur s\'est produite Veuillez réessyer';
									}					
											
								}
								
							}
							if($statut === 'Enseignant'){
								
								$email_exsist = $bdd->prepare('SELECT * FROM enseignant WHERE email=:email');
								$email_exsist->execute(array(
								'email'=>$email
							));
								if($email_exsist->rowCount()===1){
									header('Location:inscription.php');
									$_SESSION['error']='L\'email existe deja';	
								}
								else{	
										do{
											$matricule = "E".mt_rand(1,100);
											$matricule_exist = $bdd->prepare('SELECT * FROM enseignant WHERE matricule_enseignant=:matricule_enseignant');
											$matricule_exist->execute(array(
											'matricule_enseignant'=>$matricule
												));
										}while($matricule_exist->rowCount()==1);
										$stmt = $bdd->prepare("INSERT INTO enseignant (nom, prenom, email,motDePasse,matricule_enseignant,EmailConfirm,token)
													 VALUES (:nom, :prenom, :email,:motDePasse,:matricule_enseignant,:EmailConfirm,:token)");
										$stmt->bindParam(':nom', $nom);
										$stmt->bindParam(':prenom', $prenom);
										$stmt->bindParam(':email', $email);
										$stmt->bindParam(':motDePasse', $motDePasse);
										$stmt->bindParam(':matricule_enseignant', $matricule);
										$stmt->bindParam(':EmailConfirm', $EmailConfirm);
										$stmt->bindParam(':token', $token);
										if($stmt->execute()){
											sendmail($email,$nom_utilisateur,$token,$statut);
											header('Location:inscription.php');
											$_SESSION['error']='Vérifier votre boite';
										}
										else{
											header('Location:inscription.php');
											$_SESSION['error']='Une erreur s\'est produite Veuillez réessyer';
										}
																
												
									}
									
								}
							if($statut === 'Personnel'){
							
									$email_exsist = $bdd->prepare('SELECT * FROM personnel WHERE email=:email');
									$email_exsist->execute(array(
									'email'=>$email
								));
									if($email_exsist->rowCount()===1){
										header('Location:inscription.php');
										$_SESSION['error']='L\'email existe deja';	
									}
									else{	
											do{
												$matricule = "P".mt_rand(1,100);
												$matricule_exist = $bdd->prepare('SELECT * FROM personnel WHERE matricule_personnel=:matricule_personnel');
												$matricule_exist->execute(array(
												'matricule_personnel'=>$matricule
													));
											}while($matricule_exist->rowCount()==1);	
											$stmt = $bdd->prepare("INSERT INTO personnel (nom, prenom, email,motDePasse,matricule_personnel,EmailConfirm,token)
											 VALUES (:nom, :prenom, :email,:motDePasse,:matricule_personnel,:EmailConfirm,:token)");
											$stmt->bindParam(':nom', $nom);
											$stmt->bindParam(':prenom', $prenom);
											$stmt->bindParam(':email', $email);
											$stmt->bindParam(':motDePasse', $motDePasse);
											$stmt->bindParam(':matricule_personnel', $matricule);
											$stmt->bindParam(':EmailConfirm', $EmailConfirm);
											$stmt->bindParam(':token', $token);
											if($stmt->execute()){
												sendmail($email,$nom_utilisateur,$token,$statut);
												header('Location:inscription.php');
												$_SESSION['error']='Vérifier votre boite';
											}
											else{
												header('Location:inscription.php');
												$_SESSION['error']='Une erreur s\'est produite Veuillez réessyer';
											}
																	
													
										}
										
									}
						
						
						
					
			}
	   

			?>
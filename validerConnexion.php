<?php
	session_start();
	require_once 'db.php';
	$_SESSION['msg']='';
	$_SESSION['error']='';

	$email = trim(htmlspecialchars($_POST['email']));
	$motDePasse = trim(htmlspecialchars($_POST['motDePasse']));
	$motDePasse = md5(htmlspecialchars($_POST['motDePasse']));
	$statut  = $_POST['statut'];
	
	$_SESSION['email'] = $email;
	$_SESSION['statut'] = $statut;

		if($email==='admin@admin.admin' AND $motDePasse==='21232f297a57a5a743894a0e4a801fc3'){
			header('Location:admin.php');
		}
		else{
		
			if($statut === 'Etudiant'){
				$rq = $bdd->prepare('SELECT email,motDePasse FROM etudiant WHERE email =:email AND motDePasse=:motDePasse ');
										$rq ->execute(array(
											'email'=>$email,
											'motDePasse'=>$motDePasse	
										));
										
										if($rq->rowCount()===1){
											
											 header('Location:filActuEtu.php');
										}
										else{
										 header('Location:inscription.php');
										
										 $_SESSION['msg']='Champs incorrecte';
								}
			}

			if($statut === 'Enseignant'){
				
				$rq = $bdd->prepare('SELECT email,motDePasse FROM enseignant WHERE email =:email AND motDePasse=:motDePasse ');
										$rq ->execute(array(
											'email'=>$email,
											'motDePasse'=>$motDePasse	
										));
										
										if($rq->rowCount()===1){
											
											header('Location:filActuEns.php');
										}
										else{
									    header('Location:inscription.php');
										$_SESSION['msg']='Champs incorrecte';
								}
			}

			if($statut === 'Personnel'){
				
				$rq = $bdd->prepare('SELECT email,motDePasse FROM personnel WHERE email =:email AND motDePasse=:motDePasse ');
										$rq ->execute(array(
											'email'=>$email,
											'motDePasse'=>$motDePasse	
										));
										
										if($rq->rowCount()===1){
											
											header('Location:filActuPers.php');
										}
										else{
										header('Location:inscription.php');
										$_SESSION['msg']='Champs incorrecte';
								}

			}
		}
		
?>
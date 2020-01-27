<?php
	session_start();
	if (!isset($_POST['email'])){
		header('Location:index.php');
	}
	require_once 'db.php';
	$_SESSION['msg']='';
	$_SESSION['error']='';

	$email = trim(htmlspecialchars($_POST['email']));
	$motDePasse = trim(htmlspecialchars($_POST['motDePasse']));
	$motDePasse = md5(htmlspecialchars($_POST['motDePasse']));
	$statut  = $_POST['statut'];
	
	$_SESSION['email'] = $email;
	$_SESSION['statut'] = $statut;
	$EmailConfirm = 1;

		if($email==='admin@admin.admin' AND $motDePasse==='21232f297a57a5a743894a0e4a801fc3'){
			header('Location:admin.php');
		}
		else{
		
			if($statut === 'Etudiant'){
				$rq = $bdd->prepare('SELECT email,motDePasse,EmailConfirm FROM etudiant WHERE
										    email =:email AND motDePasse=:motDePasse AND EmailConfirm=:EmailConfirm ');
										$rq ->execute(array(
											'email'=>$email,
											'motDePasse'=>$motDePasse,
											'EmailConfirm'=>$EmailConfirm	
										));
										
										if($rq->rowCount()===1){
											
											 header('Location:selectPromo.php');
										}
										else{
										 header('Location:index.php');
										
										 $_SESSION['msg']='Champs incorrecte';
								}
			}

			if($statut === 'Enseignant'){
				
				$rq = $bdd->prepare('SELECT email,motDePasse FROM enseignant WHERE 
											email =:email AND motDePasse=:motDePasse AND EmailConfirm=:EmailConfirm ');
										$rq ->execute(array(
											'email'=>$email,
											'motDePasse'=>$motDePasse,
											'EmailConfirm'=>$EmailConfirm		
										));
										
										if($rq->rowCount()===1){
											
											header('Location:filActuEns.php');
										}
										else{
									    header('Location:index.php');
										$_SESSION['msg']='Champs incorrecte';
								}
			}

			if($statut === 'Personnel'){
				
				$rq = $bdd->prepare('SELECT email,motDePasse FROM personnel WHERE 
											email =:email AND motDePasse=:motDePasse AND EmailConfirm=:EmailConfirm ');
										$rq ->execute(array(
											'email'=>$email,
											'motDePasse'=>$motDePasse,
											'EmailConfirm'=>$EmailConfirm		
										));
										
										if($rq->rowCount()===1){
											
											header('Location:filActuPers.php');
										}
										else{
										header('Location:index.php');
										$_SESSION['msg']='Champs incorrecte';
								}

			}
		}
		
?>
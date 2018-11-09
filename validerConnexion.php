<?php
	session_start();
	require_once 'db.php';
	$_SESSION['msg']='';
	$_SESSION['error']='';

	$matricule = trim(htmlspecialchars($_POST['matricule']));
	$motDePasse = trim(htmlspecialchars($_POST['motDePasse']));
	$motDePasse = md5(htmlspecialchars($_POST['motDePasse']));
	$statut  = $_POST['statut'];
	
	$_SESSION['matricule'] = $matricule;
	$_SESSION['statut'] = $statut;

		if($matricule==='admin' AND $motDePasse==='14b3abeaa1bb5b452f70c26237f4428f'){
			header('Location:admin.php');
		}
		else{
		
			if($statut === 'Etudiant'){
				$rq = $bdd->prepare('SELECT * FROM etudiant WHERE matricule =:matricule AND motDePasse=:motDePasse ');
										$rq ->execute(array(
											'matricule'=>$matricule,
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
				$matricule_enseignant=$matricule;
				$rq = $bdd->prepare('SELECT * FROM enseignant WHERE matricule_enseignant =:matricule_enseignant AND motDePasse=:motDePasse ');
										$rq ->execute(array(
											'matricule_enseignant'=>$matricule_enseignant,
											'motDePasse'=>$motDePasse	
										));
										
										if($rq->rowCount()===1){
											
											header('Location:filActuEns.php');
										}
										else
										header('Location:inscription.php');
										$_SESSION['msg']='Champs incorrecte';
								}
			}

			if($statut === 'Personnel'){
				$matricule_personnel=$matricule;
				$rq = $bdd->prepare('SELECT * FROM personnel WHERE matricule_personnel =:matricule_personnel AND motDePasse=:motDePasse ');
										$rq ->execute(array(
											'matricule_personnel'=>$matricule_personnel,
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
		
?>
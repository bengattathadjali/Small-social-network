<?php 
  session_start();
  require_once 'db.php';

  $matricule = $_SESSION['matricule'];
  $statut = $_SESSION['statut'];

  $matricule = htmlspecialchars($_POST['matricule']);
  // Récupération des deux nouveaux mot de passe
 
  

  // Hachage de l'ancien mot de passe
  $motDePasse = md5(htmlspecialchars($_POST['AncienMotDePasse']));

  if($_SESSION['statut'] === 'Etudiant'){
   	$rq = $bdd->prepare('SELECT * FROM etudiant WHERE matricule =:matricule AND motDePasse=:motDePasse');
   	$rq ->execute(array(
											'matricule'=>$matricule,
											'motDePasse'=>$motDePasse	
										));
		   	if($rq->rowCount()===1){
										// Le mot de passe correspond au matricule
		   								$NouveauMotDePasse = md5(htmlspecialchars($_POST['NouveauMotDePasse']));
		   								$sql  = "UPDATE etudiant SET motDePasse=:motDePasse WHERE matricule=:matricule";
											$stmt = $bdd->prepare($sql);
											$stmt->bindValue(":motDePasse",$NouveauMotDePasse,PDO::PARAM_STR);
											$stmt->bindValue(":matricule",$matricule,PDO::PARAM_STR);
											
											$stmt->execute();
											
											header('Location:ChangerMotDePasse.php');
											$_SESSION['message']='Mot de Passe Changé';
												}
			else{
										header('Location:ChangerMotDePasse.php');
										$_SESSION['message']='Champs incorrecte';
												}
  }
/****************************************************************************************************************************************************/
  if($_SESSION['statut'] === 'Enseignant'){
    		$rq = $bdd->prepare('SELECT * FROM enseignant WHERE matricule_enseignant =:matricule_enseignant AND motDePasse=:motDePasse');
    		$rq ->execute(array(
											'matricule_enseignant'=>$matricule_enseignant,
											'motDePasse'=>$motDePasse	
										));
    		if($rq->rowCount()===1){
										// Le mot de passe correspond au matricule
    									$NouveauMotDePasse = md5(htmlspecialchars($_POST['NouveauMotDePasse']));
		   								$sql  = "UPDATE enseignant SET motDePasse=:motDePasse WHERE matricule=:matricule";
											$stmt = $bdd->prepare($sql);
											$stmt->bindValue(":motDePasse",$NouveauMotDePasse,PDO::PARAM_STR);
											$stmt->bindValue(":matricule",$matricule,PDO::PARAM_STR);
											
											$stmt->execute();
											
											header('Location:ChangerMotDePasse.php');
											$_SESSION['message']='Mot de Passe Changé';
										}
	else{
										header('Location:ChangerMotDePasse.php');
										$_SESSION['message']='Champs incorrecte';
										}
  }
/****************************************************************************************************************************************************/
  if($_SESSION['statut'] === 'Personnel'){
    $rq = $bdd->prepare('SELECT * FROM personnel WHERE matricule_personnel =:matricule_personnel AND motDePasse=:motDePasse');
    $rq ->execute(array(
											'matricule_personnel'=>$matricule_personnel,
											'motDePasse'=>$motDePasse	
										));
    		if($rq->rowCount()===1){
											// Le mot de passe correspond au matricule
    									$NouveauMotDePasse = md5(htmlspecialchars($_POST['NouveauMotDePasse']));
		   								$sql  = "UPDATE personnel SET motDePasse=:motDePasse WHERE matricule=:matricule";
											$stmt = $bdd->prepare($sql);
											$stmt->bindValue(":motDePasse",$NouveauMotDePasse,PDO::PARAM_STR);
											$stmt->bindValue(":matricule",$matricule,PDO::PARAM_STR);
											
											$stmt->execute();
											
											header('Location:ChangerMotDePasse.php');
											$_SESSION['message']='Mot de Passe Changé';
										}
	else{
										header('Location:ChangerMotDePasse.php');
										$_SESSION['message']='Champs incorrecte';
										}
  }




?>

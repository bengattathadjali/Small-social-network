<?php
	session_start();
	require_once 'db.php';
	$matricule = $_SESSION['matricule'];
	$statut = $_SESSION['statut'];
	$name = $bdd->prepare('SELECT nom,prenom FROM etudiant WHERE matricule=:matricule');
    $name->execute(array(
      'matricule'=>$matricule
    ));
    $coor = $name->fetch();
  $_SESSION['nom'] = strtolower($coor['nom']);
  $_SESSION['prenom'] = strtolower($coor['prenom']);

  $sth = $bdd->prepare('SELECT id_promo FROM etudiant WHERE matricule=:matricule ');
		$sth->execute(array(
			'matricule'=>$matricule
		));
		$id_promo = $sth->fetchColumn();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Fil D'actualité</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<link rel="stylesheet" type="text/css" href="assets/css/notification.css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link href='https://fonts.googleapis.com/css?family=Work+Sans:500,400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
	<meta charset="utf-8">
	
	<style type="text/css" media="screen">
	ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #24333C;
	} 
	li {
	    float: left;
	}

	li a {
	    display: block;
	    color: white;
	    text-align: center;
	    padding: 14px 16px;
	    text-decoration: none;
	}





	textarea{
	     width: 10em;
	     resize: none;

	}	
	</style>
</head>

<body style="background: #DCDCDC;">
	




		<ul style="background-color: #24333C;">
      <li><a href="filActuEtu.php">Flux</a></li>
      <li><a href="autreEtudiant.php">Autres Eleves</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li style="float:right"><a class="active" href="deconnexion.php" title="Déconnexion" style="background: #179D79;"><?php echo ucfirst($_SESSION['nom']).' '.ucfirst($_SESSION['prenom']);?></a></li>
      <li style="float:right"><a href="ChangerMotDepasse.php" title="Modifier Mot de Passe" target="_blanck">Compte</a></li>
      <li><a href="#" class="notification-trigger">
		<div style="font-size: 10pt;  position:absolute;top: 50%;left: 50%; color:white;"><i class="fas fa-bell"></i></div>
				<div class='notification-num'>+</div>
			</a>
		</div>
		<div class="panel">
			<div class="title">Notifications</div>
			<ul class="notification-bar">
			<?php 
			$reponse = $bdd ->prepare('SELECT * FROM publication  WHERE id_promo=:id_promo ORDER BY datePublication DESC LIMIT 5 ');
			$reponse->bindParam(':id_promo', $id_promo);
			$reponse ->execute();
			foreach ($reponse as $donnees){
			?>
				<li>
					<i class="ion-plus"></i>
					<div><?php 
					if($donnees['matricule_personnel'] === NULL){
					$matricule_enseignant = $donnees['matricule_enseignant'];
					$auteur = $bdd->prepare('SELECT nom,prenom FROM enseignant WHERE matricule_enseignant=:matricule_enseignant ');
		  			$auteur->execute(array(
		  				'matricule_enseignant'=>$matricule_enseignant
		  			));
		   			$result = $auteur->fetch();
		   			$date = date('M-l G:i', strtotime($donnees['datePublication']));

		   			echo strtolower($result['nom']).' '.strtolower($result['prenom']).' a publié :<br>'.$date.'<br>';
				}

				if($donnees['matricule_enseignant'] === NULL){
					$matricule_personnel = $donnees['matricule_personnel'];
					$auteur = $bdd->prepare('SELECT nom,prenom FROM personnel WHERE matricule_personnel=:matricule_personnel ');
		  			$auteur->execute(array(
		  				'matricule_personnel'=>$matricule_personnel
		  			));
		   			$result = $auteur->fetch();
		   			$date = date('M-l G:i', strtotime($donnees['datePublication']));

		   			echo strtolower($result['nom']).' '.strtolower($result['prenom']).' a publié :'.$date.'<br>';
				}
	
					?></div>
				</li>
			<?php } ?>
			</ul>

		</li>
    </ul>
    <br><br>

	<?php
		
		

		$stmt = $bdd->prepare('SELECT * FROM publication WHERE id_promo=:id_promo ORDER BY datePublication DESC');
		$stmt->bindValue("id_promo", $id_promo);
  		$stmt->execute();

  		$promo = $bdd->prepare('SELECT intitule FROM promo WHERE id_promo =:id_promo');
  		$promo->execute(array(
  			'id_promo'=>$id_promo
  		));

  		$intitule = $promo->fetchColumn();

  		foreach ($stmt as $key ) {?>
  			
			<div class="w3-container" >
			  <div class="w3-card-4" style="width:40%;margin: auto; background: #fff;">
			    <header class="w3-container w3-light-grey">
			    	<?php
  				if($key['matricule_personnel'] === NULL){
	  			$matricule_enseignant = $key['matricule_enseignant'];
	  			
	  			$aut = $bdd->prepare('SELECT nom,prenom,email FROM enseignant WHERE matricule_enseignant=:matricule_enseignant ');
	  			$aut->execute(array(
	  				'matricule_enseignant'=>$matricule_enseignant
	  			));
	   			$result = $aut->fetch();
	  			?>
		  			<h3><?php echo '@'.strtolower($result['nom']).' '.strtolower($result['prenom']);?>
		  			</header>
		  			<div class="w3-container">
		  				<p><?php $date = date('M-l G:i', strtotime($key['datePublication'])); 
		  				echo $date; ?></p>
		  				<hr>
		  				<p style ="position: right;"><?php echo $key['contenu']?></p><br>
		  			<?php if($key['name_file'] !== NULL){
 			 		echo "<a target='_blank' href=view.php?FileNo=".$key['name_file'].">".$key['name_file']."</a>";
 			 		} ?></div>
	  					<button class="w3-button w3-block w3-green" onclick="location.href='mailto:<?php echo $result['email'];?>?subject=Demande d\'information&body=A propos :%0D%0A<?php echo $key['contenu']?>'">Contacter</button>
	  					</div>
	  				</div></center><br>

	  			<?php }

  			if($key['matricule_enseignant'] === NULL){
  				$matricule_personnel = $key['matricule_personnel'];
  			
	  			$aut = $bdd->prepare('SELECT nom,prenom,email FROM personnel WHERE matricule_personnel=:matricule_personnel ');
	  			$aut->execute(array(
	  				'matricule_personnel'=>$matricule_personnel
	  			));
	   			$result = $aut->fetch();?>
	  			<h3><?php echo '@'.strtolower($result['nom']).' '.strtolower($result['prenom']);?>
		  			</header>
		  			<div class="w3-container">
		  				<p><?php $date = date('M-l G:i', strtotime($key['datePublication'])); 
		  				echo $date; ?></p>
		  				<hr>
		  				<p><?php echo $key['contenu']?></p><br>
		  			<?php if($key['name_file'] !== NULL){
 			 		echo "<a target='_blank' href=view.php?FileNo=".$key['name_file'].">".$key['name_file']."</a>";
 			 		} ?></div>
		  				<button class="w3-button w3-block w3-green" onclick="location.href='mailto:<?php echo $result['email'];?>?subject=Demande d\'information&body=A propos :%0D%0A<?php echo $key['contenu']?>'">Contacter</button>
		  				</div>

		  				</div><br>
	  			<?php }}
  		?>
	
			
	<script type="text/javascript">
		$(document).ready(function() {
	$('.notification-trigger').click(function() {
		$('.panel').toggleClass('visible');
	});
})
	</script>
</body>
</html>
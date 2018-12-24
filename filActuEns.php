<?php
	session_start();
	if(!isset($_SESSION['email']))
		header('Location:inscription.php');
	require_once 'db.php';
	$email = $_SESSION['email'];
	// $statut = $_POST['statut'];
	$name = $bdd->prepare('SELECT nom,prenom FROM enseignant WHERE email=:email');
 		$name->execute(array(
 			'email'=>$email
 		));
		 $coor = $name->fetch();
	
 	$_SESSION['nom'] = strtolower($coor['nom']);
	 $_SESSION['prenom'] = strtolower($coor['prenom']);
	
	 $matricule = $bdd->prepare('SELECT matricule_enseignant FROM enseignant WHERE email=:email');
 		$matricule->execute(array(
 			'email'=>$email
 		));
		 $coor_1 = $matricule->fetch();
		 $_SESSION['matricule_enseignant'] = $coor_1['matricule_enseignant'];
 	//$_SESSION['champs']=NULL;	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Fil D'actualité</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/Menu.css">
</head>

<body style="background: #e9ebee;">
		<ul style="background-color: #24333C;">
		  <li><a href="filActuEns.php">Flux</a></li>
		  <li><a href="AutresEtudiantE.php">Autres Eleves</a></li>
		  <li><a href="contactE.php">Contact</a></li>
		  
		  <li style="float:right"><a class="active" href="deconnexion.php" title="Déconnexion" style="background: #179D79;"><?php echo ucfirst($_SESSION['nom']).' '.ucfirst($_SESSION['prenom']); ?></a></li>
		 
		</ul>
		<br><br>

<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------->		
<!-- Section Publication -->

	<div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    margin: auto;
    width: 40%;">
    
   
	<table border="1" style="background: #fff;">
	<tr><th>

	 <div class="row" >
	    <form class="col s5" action="AjouterPubEns.php" method="POST" enctype="multipart/form-data">
	      <div class="row">
	        <div class="input-field col s12">
	        	<textarea name="contenu" class="materialize-textarea" placeholder="Ecrivez votre texte"></textarea>
	        </div>
	      </div>
		  <?php 
			
		    $reponse = $bdd->query('SELECT id_promo FROM enseigne WHERE matricule_enseignant=\'' .$_SESSION['matricule_enseignant']. '\' ');

		    while ($donnees = $reponse->fetch()){
		      $id_promo = $donnees['id_promo'];

		      $rs = $bdd->query('SELECT * FROM promo WHERE id_promo=\'' . $id_promo. '\' ');
		      
		      while ($dn = $rs->fetch()){
		       echo ' <p>
      <label><input type="checkbox" value=\''.$dn['id_promo'].'\' name="promo[]"/><span>'.$dn['intitule'].'</span></label></p>';

		     
		      
		      }
		     
		      
		   }
		  ?>
		  
		  <div class="file-field input-field">
		      <div class="btn">
		        <span><i class="material-icons center">attach_file</i></span>
		        <input type="file" name="fichier">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
      	 	  </div>
    	   </div>
	       <div style="color: red;"><p><?php if(isset($_SESSION['champs']))  echo $_SESSION['champs']; ?></p></div>
	      <button class="btn waves-effect waves-light" type="submit" name="action">Publier
		   <i class="material-icons right">send</i>
		  </button>
		
	

	    </form>
 	 </div>
 	</th></tr>
 	</table></div><br><br>

<!-- Section Publication -->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------->
 	
 	<?php 
 		$st = $bdd->prepare('SELECT * FROM publication WHERE matricule_enseignant=:matricule_enseignant ORDER BY datePublication DESC');
 		$st->execute(array(
 			'matricule_enseignant'=>$_SESSION['matricule_enseignant']
 		));

 		$aut = $bdd->prepare('SELECT nom,prenom FROM enseignant WHERE matricule_enseignant=:matricule_enseignant');
 		$aut->execute(array(
 			'matricule_enseignant'=>$_SESSION['matricule_enseignant']
 		));
 		$result = $aut->fetch();
 		
 		foreach ($st as $key ) {?>
 		<div class="w3-container">
		  <div class="w3-card-4" style="width:40%; margin: auto; background: #fff; " >
		    <header class="w3-container w3-light-grey">
 			<?php $id_promo = $key['id_promo'];
 			$promo = $bdd->prepare('SELECT intitule FROM promo WHERE id_promo=:id_promo');
 			$promo->execute(array(
 				'id_promo'=>$id_promo
 			));
 			$id=$key['id_publication'];
 			$intitule = $promo->fetchColumn();?>
 			<h3><?php echo '@'.strtolower($result['nom']).' '.strtolower($result['prenom']);?></h3>
 			</header>
 			 <div class="w3-container">
 			 	<p><?php $date = date('M-l G:i', strtotime($key['datePublication'])); 
 			 	echo $intitule.' '.'<b>'.$date.'</b>' ?></p>
 			 	<hr>
 			 	<p><?php echo $key['contenu']; ?> </p><br>
 			 	

 			 	<?php if($key['name_file'] !== NULL){
 			 		echo "<a target='_blank' href=view.php?name_file=".$key['name_file'].">".$key['name_file']."</a>";
 			 	} ?></div>
 			 	<button class="w3-button w3-block w3-red"><a href="SuppPubEns.php?id=<?php echo $id;?>"  onclick="return confirm('Êtes vous sûr de supprimer?')" >Supprimer</a></button>

 			 	</div>
				</div><br>
 		<?php }?>

 	
      
 	 
</body>
</html>



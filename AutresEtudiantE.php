<?php 
	session_start();
	require_once 'db.php';
	$matricule_enseignant = $_SESSION['matricule'];


?>

<!DOCTYPE html>
<html lang="fr" >

<head>
  <meta charset="UTF-8">
  <title>Autres Etudiants</title>
  <link rel="stylesheet" type="text/css" href="assets/css/autreEtudiant.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" type="text/css" href="assets/css/Menu.css">
  
</head>

<body>
	<ul style="background-color: #24333C;">
      <li><a href="filActuEns.php">Flux</a></li>
      <li><a href="AutresEtudiantE.php">Autres Eleves</a></li>
      <li><a href="contactE.php">Contact</a></li>
      <li style="float:right"><a class="active" href="deconnexion.php" title="Déconnexion" style="background: #179D79;"><?php echo ucfirst($_SESSION['nom']).' '.ucfirst($_SESSION['prenom']);?></a></li>
       <li style="float:right"><a href="ChangerMotDepasse.php" title="Modifier Mot de Passe" target="_blanck">Compte</a></li>
    </ul>
    <br><br>

 <div class="w3-container">
  <h2>Liste des Etudiants</h2>

  <table class="w3-table-all">
    <thead>
      <tr class="w3" style="background:#179D79; ">
        <th style="color: white;">Nom</th>
        <th style="color: white;">Prénom</th>
        <th style="color: white;">Email</th>
        <th style="color: white;">Promo</th>
      </tr>
    </thead>
   
                        <?php
                           $id_promo = $bdd->query('SELECT id_promo FROM enseigne WHERE matricule_enseignant=\'' .$matricule_enseignant. '\' ');
                           
                         	 foreach ($id_promo as $id){
                               $id_promo = $id['id_promo'];
                                $etudiant = $bdd->query('SELECT * FROM etudiant WHERE id_promo=\'' . $id_promo. '\' ORDER BY id_promo DESC ');

                                  foreach ($etudiant as $donnees) {
                                     $intitule = $bdd->query('SELECT intitule FROM promo WHERE id_promo=\'' . $id['id_promo']. '\' ');
                                     $nom_intitule = $intitule->fetch();
                                    echo '<tr>    
                                           <td>'.$donnees['nom'].'</td>
                                           <td>'.$donnees['prenom'].'</td>   
                                           <td>'.$donnees['email'].'</td>
                                           <td>'.$nom_intitule['intitule'].'</td>
                                          </tr>';
                                  }
                                }
                           
                           
                            ?>
         
        </table>
</div>





</body>

</html>
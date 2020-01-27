<?php 
  session_start();
  if(!isset($_SESSION['email']))
		header('Location:index.php');
	require_once 'db.php';
	$matricule_enseignant = $_SESSION['matricule_enseignant'];


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
       
    </ul>
    <br><br>

 <div class="w3-container">
  <h2>Liste des Enseignants</h2>

  <table class="w3-table-all">
    <thead>
      <tr class="w3" style="background:#179D79; ">
        <th style="color: white;">Nom</th>
        <th style="color: white;">Prénom</th>
        <th style="color: white;">Email</th>
        
      </tr>
    </thead>
   
                        <?php
                           $enseignant = $bdd->query('SELECT * FROM enseignant ORDER BY nom,prenom DESC ');
                           
                         	 foreach ($enseignant as $donnees){
                               
                                    echo '<tr>    
                                           <td>'.$donnees['nom'].'</td>
                                           <td>'.$donnees['prenom'].'</td>   
                                           <td>'.$donnees['email'].'</td>
                                         
                                          </tr>';
                                  
                                }
                           
                           
                            ?>
         
        </table>
</div>

  <div class="w3-container">
  <h2>Liste du  Personnels</h2>

  <table class="w3-table-all">
    <thead>
      <tr class="w3" style="background:#179D79; ">
        <th style="color: white;">Nom</th>
        <th style="color: white;">Prénom</th>
        <th style="color: white;">Email</th>
        
      </tr>
    </thead>
   
                         <?php
                           $personnel = $bdd->query('SELECT * FROM personnel ORDER BY nom,prenom DESC ');
                           
                           foreach ($personnel as $donnees){
                               
                                    echo '<tr>    
                                           <td>'.$donnees['nom'].'</td>
                                           <td>'.$donnees['prenom'].'</td>   
                                           <td>'.$donnees['email'].'</td>
                                         
                                          </tr>';
                                  
                                }
                           
                           
                            ?>
         
        </table>
</div>




</body>

</html>
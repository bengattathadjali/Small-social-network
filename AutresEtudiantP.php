<?php 
	session_start();
	require_once 'db.php';
	$matricule_personnel = $_SESSION['matricule_personnel'];


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
	<ul style="background-color: #1e1e4b;">
      <li><a href="filActuPers.php">Flux</a></li>
      <li><a href="AutresEtudiantP.php">Autres Eleves</a></li>
      <li><a href="contactP.php">Contact</a></li>
      <li style="float:right"><a class="active" href="deconnexion.php" title="Déconnexion" style="background: #ffbc3b;"><?php echo $_SESSION['nom'].' '.$_SESSION['prenom'];?></a></li>
       
    </ul>
    <br><br>

 <div class="w3-container">
  <h2>Liste des Etudiants</h2>

  <table class="w3-table-all">
    <thead>
      <tr class="w3" style="background:#1e1e4b; ">
        <th style="color: white;">Nom</th>
        <th style="color: white;">Prénom</th>
        <th style="color: white;">Email</th>
        
      </tr>
    </thead>
   
                        <?php
                          
                           
                        
                                $etudiant = $bdd->query('SELECT * FROM etudiant ORDER BY nom DESC ');

                                  foreach ($etudiant as $donnees) {
                                    
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
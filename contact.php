<?php 
  session_start();
  if(!isset($_SESSION['email']))
		header('Location:inscription.php');
	require_once 'db.php';
	

?>

<!DOCTYPE html>
<html lang="fr" >

<head>
  <meta charset="UTF-8">
  <title>Autres Etudiants</title>
  <link rel="stylesheet" type="text/css" href="assets/css/autreEtudiant.css">
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

<body>
	<ul style="background-color: #24333C;">
      <li><a href="filActuEtu.php?id_promo=1">Flux</a></li>
      <li><a href="autreEtudiant.php">Autres Eleves</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li style="float:right"><a class="active" href="deconnexion.php" title="Déconnexion" style="background: #179D79;"><?php echo ucfirst($_SESSION['nom']).' '.ucfirst($_SESSION['prenom']);?></a></li>
      
      
    
      </ul>

    </li>
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
                           $rq = $bdd->prepare('SELECT * FROM enseigne ');
                            $rq->execute();
                             foreach ($rq as $key ) {
                              $matricule_enseignant = $key['matricule_enseignant'];
                              
                              $enseignant = $bdd->prepare('SELECT * FROM enseignant  WHERE matricule_enseignant=\'' . $matricule_enseignant. '\'');
                              $enseignant->execute();
                              

                             foreach ($enseignant as $donnees){
          
                                    echo '<tr>    
                                           <td>'.$donnees['nom'].'</td>
                                           <td>'.$donnees['prenom'].'</td>   
                                           <td>'.$donnees['email'].'</td>
                                         
                                          </tr>';
                                  
                                }
                           }
                           
                            ?>
         
        </table>
</div>

   <div class="w3-container">
  <h2>Liste du Personnel</h2>

  <table class="w3-table-all">
    <thead>
      <tr class="w3" style="background:#179D79; ">
        <th style="color: white;">Nom</th>
        <th style="color: white;">Prénom</th>
        <th style="color: white;">Email</th>
        
      </tr>
    </thead>
   
                        <?php
                           $rq = $bdd->prepare('SELECT * FROM dirige ');
                            $rq->execute();
                             foreach ($rq as $key ) {
                              $matricule_personnel = $key['matricule_personnel'];
                              
                              $enseignant = $bdd->prepare('SELECT * FROM personnel  WHERE matricule_personnel=\'' . $matricule_personnel. '\'');
                              $enseignant->execute();
                              

                             foreach ($enseignant as $donnees){
          
                                    echo '<tr>    
                                           <td>'.$donnees['nom'].'</td>
                                           <td>'.$donnees['prenom'].'</td>   
                                           <td>'.$donnees['email'].'</td>
                                         
                                          </tr>';
                                  
                                }
                           }
                           
                            ?>
         
        </table>
</div>




<script type="text/javascript">
    $(document).ready(function() {
  $('.notification-trigger').click(function() {
    $('.panel').toggleClass('visible');
  });
})
  </script>

</body>

</html>

 
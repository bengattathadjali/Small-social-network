<?php 
  session_start();
  if(!isset($_SESSION['email']))
		header('Location:inscription.php');
  require_once 'db.php';
  $matricule = $_SESSION['matricule'];

   $sth = $bdd->prepare('SELECT id_promo FROM etudiant WHERE matricule=:matricule ');
    $sth->execute(array(
      'matricule'=>$matricule
    ));
    $id_promo = $sth->fetchColumn();
  

?>



<!DOCTYPE html>
<html lang="fr" >

<head>
  <meta charset="UTF-8">
  <title>Autres Etudiants</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  

  <link rel="stylesheet" type="text/css" href="assets/css/notification.css">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link href='https://fonts.googleapis.com/css?family=Work+Sans:500,400,300' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
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
      $reponse = $bdd ->prepare('SELECT * FROM publication  WHERE id_promo=:id_promo ORDER BY datePublication DESC ');
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

 <div class="w3-container">
  <h2>Liste des Etudiants</h2>

  <table class="w3-table-all">
    <thead>
      <tr class="w3" style="background:#179d79; ">
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
      </tr>
    </thead>
   
                        <?php
                           $sth = $bdd->prepare('SELECT id_promo FROM etudiant WHERE matricule=:matricule ');
                           $sth->execute(array(
                             'matricule'=>$matricule
                           ));
                           $id_promo = $sth->fetchColumn();
                          
                            $reponse = $bdd ->prepare('SELECT * FROM etudiant WHERE id_promo =\'' .$id_promo. '\'');
                            $reponse->execute();
                            while ($donnees = $reponse->fetch()){
                              if($donnees['matricule']!=$matricule)
                             echo '<tr>    
                                         <td>'.$donnees['nom'].'</td>
                                         <td>'.$donnees['prenom'].'</td>   
                                         <td>'.$donnees['email'].'</td>
                                   </tr>';
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

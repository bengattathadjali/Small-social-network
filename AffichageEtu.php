<?php 
    require_once 'db.php';
    session_start();
    if(!isset($_SESSION['email']))
    header('Location:inscription.php');
?>
<!DOCTYPE html>
<html lang="fr" >

<head>
  <meta charset="UTF-8">
  <title>Affichage Des Etudiants</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
  
  
      <link rel="stylesheet" href="assets/css/style_2.css">

  
</head>

<body>
    
  <div class="container">
    <div class="card">
        <div class="row card-title">
            <span class="col s3">
                Liste Des Etudiants
            </span>
            <div class="col s9">
                <div class="btnWrapper">
                    
                    <a id="btnSearch" class="btn-floating btn-small waves-effect waves-light right"><i class="material-icons">search</i></a>
                    <span class="teal lighten-1 right searchWrapper" style="display: none">
                        <input id="searchInput" type="search">
                    </span>
                </div>
            </div>
        </div>
        <div class="row card-content">
            <ul class="collapsible">
                <li class="collapsible-header">
                    <div class="col s4 center"><strong>Nom</strong></div>
                    <div class="col s4 center"><strong>Prénom</strong></div>
                    <div class="col s4 center"><strong>Matricule</strong></div>
                     <div class="col s4 center"><strong>Email</strong></div>
                     <div class="col s4 center"><strong>Promo</strong></div>
                     <div class="col s4 center"></div>
                </li>
   
                        <?php
                            $reponse = $bdd ->query('SELECT nom,prenom,email FROM etudiant ORDER BY email DESC');
                            
                           
                            foreach ($reponse as $donnees){
                            
                             
                            
                            
                            
                             echo '<ul><li>
                                     <div class="collapsible-header line" tabindex="0">
                                         <div class="col s4 center">'.$donnees['nom'].'</div>
                                         <div class="col s4 center">'.$donnees['prenom'].'</div>
                                         
                                         <div class="col s4 center">'.$donnees['email'].'</div>
                                        
                                         <div class="col s4 center">
                                           <a onclick="return confirm(\'Êtes vous sûr de supprimer?\')" href="TraitementSuppEtu.php?email='.$donnees['email'].'" 
                                           class="waves-effect waves-light btn-small">Supprimer</a>
                                       </div>
                                        
                                     </div>
                                   </li></ul>';
                            
                            }
                            ?>
         
            </ul>
        </div>
    </div>
</div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.js'></script>

  

    <script  src="assets/js/index_2.js"></script>




</body>

</html>

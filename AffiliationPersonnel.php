<?php 
	session_start();
    require_once 'db.php';
    if(!isset($_SESSION['email']))
    header('Location:inscription.php');

?>

<!DOCTYPE html>
<html lang="fr" >

<head>
  <meta charset="UTF-8">
  <title>Affiliation Personnel</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
  
  
      <link rel="stylesheet" href="assets/css/style_2.css">
      
  
</head>

<body>
  
  <div class="container">
    <div class="card">

        <div class="row card-title">
            <span class="col s3">
                Affiliation Personnel
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
                     <div class="col s4 center"><strong>Promo</strong></div>
                     <div class="col s4 center"></div>
                </li>
   
                        <?php
                            $reponse = $bdd ->query('SELECT * FROM dirige ORDER BY matricule_personnel DESC');
                            foreach ($reponse as $donnees){
                            	$matricule_personnel = $donnees['matricule_personnel'];
                            	$promo = $donnees['id_promo'];

                            	$personnel = $bdd->query('SELECT * FROM personnel WHERE matricule_personnel=\'' . $matricule_personnel. '\' ');
                            	$intitule = $bdd->query('SELECT * FROM promo WHERE id_promo=\'' . $promo. '\'');
                            	foreach ($personnel as $key) {
                            		foreach ($intitule as $rq ) {
                            			 echo '<ul><li>
                                     <div class="collapsible-header line" tabindex="0">
                                         <div class="col s4 center">'.$key['nom'].'</div>
                                         <div class="col s4 center">'.$key['prenom'].'</div>
                                         <div class="col s4 center">'.$key['matricule_personnel'].'</div>
                                         <div class="col s4 center">'.$rq['intitule'].'</div>
                                         <div class="col s4 center">
                                           <a onclick="return confirm(\'Êtes vous sûr de supprimer?\')" href="SuppAffiliationPers.php?matricule_personnel='.$matricule_personnel.'&promo='.$rq['id_promo'].'" 
                                           class="waves-effect waves-light btn-small">Supprimer</a>
                                       </div>

                                     </div>
                                   </li></ul>';
                            		}
                            	}
                            
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

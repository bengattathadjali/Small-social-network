<?php
  session_start();
  if(!isset($_SESSION['email']))
		header('Location:inscription.php');
 // $_SESSION['error_2']='';
  //$_SESSION['msg_2']='';

?>
<!DOCTYPE html>
<html lang="fr" >

<head>

  <meta charset="UTF-8">
  <title>Administration</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
     <script type="text/javascript" src="assets/js/admin.js"></script>
     
      <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" href="assets/css/style_4.css">
      <style type="text/css">

     
      </style>
  
</head>

<body>
 <a href="deconnexion.php"><i id="play_button" class="fas fa-sign-out-alt fa-lg"></i></a>
  <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#Inscrption">Inscrption</a></li>
        <li class="tab"><a href="#Affiliation">Affiliation</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="Inscrption">   
          <h1>Entrez les coordonnées</h1>
          
          <form action="TraitAdmin.php" method="POST">
          
          <div class="top-row">
            <div class="field-wrap">
              <label>
                Nom<span class="req">*</span>
              </label>
              <input type="text" name="nom" required autocomplete="off" />
            </div>
        
            <div class="field-wrap">
              <label>
                Prénom<span class="req">*</span>
              </label>
              <input type="text"required name="prenom" autocomplete="off"/>
            </div>
          </div>



          <div class="field-wrap">
            <label>
              Matricule<span class="req">*</span>
            </label>
            <input type="text"required name="matricule" autocomplete="off"/>
          </div>

          
          <div class="field-wrap">
            <label>
              Code promo<span class="req" >*</span>
            </label>
            <input type="text"required name="promo" id="promo" autocomplete="off"  />
          </div>

          <center>
             <span class="custom-dropdown">
                <select name="statut">
                  <option >Enseignant</option>
                  <option>Etudiant</option>
                  <option>Personnel</option>
                </select>
            </span>
          </center>
            <br><br>

          <center><b><p style="color:white;  font-size: 20px;"><?php if(isset($_SESSION['error_2']))  echo $_SESSION['error_2']; ?></p></b></center>
          

            <button type="submit" class="button button-block"/>Ajouter</button><br><br>
            
          </form>
           <a href="AffichageEtu.php" target="_blank"><button type="submit"  class="button button-block"/>Afficher Etudiant</button></a><br>
           <a href="AffichageEns.php" target="_blank"><button type="submit"  class="button button-block"/>Afficher Enseignant</button></a><br>
            <a href="AffichagePers.php" target="_blank"><button type="submit"  class="button button-block"/>Afficher Personnel</button></a><br>
        </div>
        
        <div id="Affiliation">   
          <h1>Entrer les coordonnées</h1>
          
          <form action="TraitAffil.php" method="POST">
          
            <div class="field-wrap">
	            <label>
	              Matricule<span class="req">*</span>
	            </label>
            	<input type="text"required name="matricule" autocomplete="off"/>
            </div>
          
        	<div class="field-wrap">
            <label>
              Code promo<span class="req">*</span>
            </label>
            <input type="text"required name="promo" autocomplete="off"/>
          </div>

          <center>
             <span class="custom-dropdown">
                <select name="statut">
                  <option >Enseignant</option>
                  <option>Personnel</option>
                </select>
            </span>
          </center>
          <br><br>

          <center><b><p style="color:white;  font-size: 20px;"><?php if(isset($_SESSION['msg_2'])) echo $_SESSION['msg_2']; ?></p></b></center>
          <button type="submit" class="button button-block"/>Ajouter</button>
          
          </form><br><br>
          
             <a href="AffiliationEnseignant.php" target="_blank"><button type="submit"  class="button button-block"/>Affiliation Enseignant</button></a><br>
              <a href="AffiliationPersonnel.php" target="_blank"><button type="submit"  class="button button-block"/>Affiliation Personnel</button></a><br>
              <a href="AffiliationEtudiant.php" target="_blank"><button type="submit"  class="button button-block"/>Affiliation Etudiant</button></a><br>
        </div>
        
      </div>
      
</div>
      
      

      
      
  	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script  src="assets/js/index.js"></script>




</body>



</html>

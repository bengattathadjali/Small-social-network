<?php
  session_start();
  //$_SESSION['error']='';
  //$_SESSION['msg']='';

?>
<!DOCTYPE html>
<html lang="fr" >

<head>
  <meta charset="UTF-8">
  <title>Inscription/Connexion</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" href="assets/css/style_4.css">
  
</head>

<body>
 


  <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Inscrption</a></li>
        <li class="tab"><a href="#login">Connexion</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Entrez vos coordonnées</h1>
          
          <form action="validerInscription.php" method="POST">
          
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
              Email<span class="req">*</span>
            </label>
            <input type="email"required name="email" autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Mot De Passe<span class="req">*</span>
            </label>
            <input type="password"required name="motDePasse" autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
              Matricule<span class="req">*</span>
            </label>
            <input type="text"required name="matricule" autocomplete="off"/>
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
                    <center><b><p style="color:white;  font-size: 20px;"><?php if (isset($_SESSION['error']))
                                                                        echo $_SESSION['error']; 
                                                                ?>
                                                                  
                                                                </p></b></center>
        

            <button type="submit" class="button button-block"/>Créer un Compte</button>
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Bienvenue !</h1>
          
          <form action="validerConnexion.php" method="POST">
          
            <div class="field-wrap">
            <label>
              E-mail<span class="req">*</span>
            </label>
            <input type="email"required name="email" autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Mot De Passe<span class="req">*</span>
            </label>
            <input type="password"required name="motDePasse" autocomplete="off"/>
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
          
          <p class="forgot"><a href="PasseOublie.php" target="_blanck">Mot De Passe Oublié?</a></p>
          <center><b><p style="color:white;  font-size: 20px;"><?php if (isset($_SESSION['msg'])) echo $_SESSION['msg']; ?></p></b></center>
          <button type="submit" class="button button-block"/>Connexion</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="assets/js/index.js"></script>




</body>



</html>

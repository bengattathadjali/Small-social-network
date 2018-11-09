<?php 
  session_start();
  require_once 'db.php';
  $matricule = $_SESSION['matricule'];

?>
<!DOCTYPE html>
<html lang="fr" >

<head>
  <meta charset="UTF-8">
  <title>Changer Mot de Passe</title>
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="assets/css/ChangerMotDepasse.css">

  
</head>

<body>

  <form action="TraitChangerMotDePasse.php" method="POST">
  <p>
    <label for="username">Matricule</label>
    <input id="username" name="matricule" type="text">
  </p>

   <p>
    <label>Ancien Mot De Passe</label>
    <input   name="AncienMotDePasse" type="password">
  
  </p>

  <p>
    <label for="password">Nouveau Mot De Passe</label>
    <input id="password"  name="NouveauMotDePasse" type="password">
    <span>Mot de passe doit contenir 8 caracteres</span>
  </p>
  <p>
    <label for="confirm_password">Retapez Mot De Passe</label>
    <input id="confirm_password" name="confirmMotDePasse" type="password">
    <span>Les mots de passes ne correspondent pas</span>
  </p>
  <center><b><p style="color: red;"><?php if(isset($_SESSION['message'])) echo $_SESSION['message']; ?></p></b></center>
  <p>
    <input type="submit" value="Changer Mot de passe" id="submit">
  </p>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
</form>
 

  

    <script  src="assets/js/ChangerMotDepasse.js"></script>




</body>

</html>

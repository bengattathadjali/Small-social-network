<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=mabase;charset=utf8', 'root', '');
}
catch(Exception $e)
{
		echo 'Nous avons un petit probléme sur le site veuiller réessayer plus tard<br/>';
        die('Erreur : '.$e->getMessage());
}
?>
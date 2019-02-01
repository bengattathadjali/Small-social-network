<?php

	session_destroy();
	session_unset();
	header("location: inscription.php");
?>
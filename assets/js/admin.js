	
	function disableText()
		{
			
			if (document.getElementById('statut').value == "Etudiant") {
				document.getElementById('promo').disabled=false;

			}
			else {
				document.getElementById('promo').disabled=true;
				
			}
		}
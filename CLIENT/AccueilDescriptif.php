<html>
		<head>
				<title>Descriptif d'un film</title>
		</head>

		<body>

	<?php 
		include 'Outils.inc'; 
		echo banniere("AccueilDescriptif.php", "Ikhlef & Blaszkiewicz"); 
	?>
	
 	
	 
 		<form method="POST" action="Descriptif.php">
 					<fieldset style="border-radius:5px; border-color: green; width : 20%; margin : auto; margin-top :7%;"">
 								<legend style="color : green;">Descriptif d'un film</legend>
 								<input type="text" name="NUMEROFILM" placeholder="Numéro du film" style="border-radius:5px;margin:auto; broder-color : green;" >
 								<input type="submit" name="envoie" value="Go" style="margin:auto;margin-left:10%; border-radius:5px;box-shadow : 3px 3px 3px green;" >
 					</fieldset>
 		</form>
	</body>
</html>


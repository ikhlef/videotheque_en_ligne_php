<html>
	<head>
		<title>IdentificationC</title>
	</head>

	<body>

	<?php 
		include 'Outils.inc'; 
		echo banniere("IdentificationC.php", "Ikhlef & Blaszkiewicz"); 
	?>
	
 
  	<form method="POST" action="Commande.php">
  				<fieldset style="border-radius:5px; border-color: green; width : 30%; margin :auto;margin-top :7%;">
  							<legend style="color : green;">IdentificationC</legend>
 								<input type="text" name="NOM" placeholder="Nom" style="border-radius:5px;margin:auto; margin-left:30%; broder-color : green;"><br/>
 								<input type="text" name="PASS" placeholder="Pass" style="border-radius:5px;margin:auto;margin-left:30%; broder-color : green;" ><br/>
 								<input type="submit" name="envoie" value="Go" style="margin:auto;margin-left:45%; border-radius:5px;box-shadow : 3px 3px 3px green;" >
 					</fieldset>
 		</form>
 	</body>
</html>
 


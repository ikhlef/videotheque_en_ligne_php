<html>
	<head>
		<title>IdentificationD</title>
	</head>
	<body>

	<?php 
		include 'Outils.inc'; 
		echo banniere("IdentificationD.php", "Ikhlef & Blaszkiewicz"); 
	?>	
 
  	<form method="POST" action="Detenues.php">
  				<fieldset style="border-radius:5px; border-color: green; width : 30%; margin :auto;margin-top :7%;">
  							<legend style="color : green;">IdentificationD</legend>
 								<table>Nom : <input type="text" name="NOMABONNE" placeholder="Nom" style="border-radius:5px;margin:auto; margin-left:30%;border-color : green;"></br>Numéro : <input type="text" name="NUMEROABONNE" placeholder="Num&eacute;ro abonn&eacute;" style="border-radius:5px;margin:auto; margin-left:30%;border-color : green;"></br>
 								<input type="submit" name="envoie" value="Go" style="margin:auto;margin-left:45%; border-radius:5px; box-shadow : 3px 3px 3px green" ></br>
 								</table>
 					</fieldset>
 		</form>
 	</body>
 </html>

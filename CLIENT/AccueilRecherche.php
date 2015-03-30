<html>
	<head>
   	<title>Recherche de films</title>
	</head>
	<body>

	<?php 
		include 'Outils.inc'; 
		echo banniere("AccueilRecherche.php", "Ikhlef & Blaszkiewicz"); 
	?>
	


 		<form method="POST" action="Recherche.php">
 			<fieldset style="border-radius:5px; border-color: green; width : 50%; margin :auto;margin-top :7%;">
 				<legend style="color : green;"><font size=6> Recherche de films</font></legend>
 				
 				<input type="text" name="TITRE" placeholder="Titre" style=" width : 50%;border-radius:5px;margin:auto; margin-left:30%;broder-color : green;" >
 				
   			<div style="border-radius:5px;margin:auto; margin-left:31%;color:green; text-shadow : 5px 5px 5px green;">Support : <select name="SUPPORT" size="1">
   				<option value="DVD"> DVD
   				<option value="VHS"> VHS
   				<option selected="selected" value="indifférent"> indifférent
					</select>
				</div>

	 			<div style="border-radius:5px;margin:auto; margin-left:31%;color:green; text-shadow : 5px 5px 5px green;">Disponibilité : <select name="DISPO" size="1">
   				<option value="disponible"> disponible
   				<option selected="selected" value="indifférent"> indifférent
					</select>
				</div>

				<div style="border-radius:5px;margin:auto; margin-left:31%;color:green; text-shadow : 5px 5px 5px green;">Genre : <?php
				
  			
  			/* Première version
  			
				$id = mysql_pconnect("localhost", "video43", "2223");
				if ($id == 0) {
  				echo "Erreur de connexion au serveur MySQL";
  				exit;
				}
				if (mysql_select_db("video43", $id) == 0) {
  				echo "Erreur d'accès à la base video43";
  				exit;
				}

				$id_rep = mysql_query("select distinct (f.Genre) from FILMS f", $id);

				echo "<select name='GENRE' size='1'>";
				echo "<option selected='selected' value='indifférent'>indifférent</option>";
				if($id_rep != 0)  {
  			while ($genre_tmp = mysql_fetch_object($id_rep)) 
    		echo "<option>$genre_tmp->Genre</option>";
				}	
				echo "</select>";
				*/
				
				// Version Outils.inc
				
				$id=DB_connect();
				
				$rep=DB_execSQL("select distinct (f.Genre) from FILMS f", $id);
				
				echo "<select name='GENRE' size='1'>";
				echo "<option selected='selected'>indifférent</option>";
				if($rep != 0)  {
  			while ($genre_tmp = mysql_fetch_object($rep)) 
    			echo "<option>$genre_tmp->Genre</option>";
				}	
				echo "</select>";
 				?>

 				</div>
 
 				<div style="border-radius:5px;margin:auto; margin-left:31%;color:green; text-shadow : 5px 5px 5px green;">Réalisateur : <?php
 				
				/* Première version
				
				$id = mysql_pconnect("localhost", "video43", "2223");
				if ($id == 0) {
  			echo "Erreur de connexion au serveur MySQL";
  			exit;
				}
				if (mysql_select_db("video43", $id) == 0) {
  			echo "Erreur d'accès à la base video43";
  			exit;
				}
				

				$id_rep = mysql_query("select distinct (f.Realisateur) from FILMS f", $id);

				echo "<select name='REALISATEUR' size='1'>";
				echo "<option selected='selected'>indifférent</option>";
				if($id_rep != 0)  {
  			while ($genre_tmp = mysql_fetch_object($id_rep)) 
    			echo "<option>$genre_tmp->Realisateur</option>";
				}	
				echo "</select>";
				*/
				
				// Version Outils.inc
				
				$id=DB_connect();
				
				$rep=DB_execSQL("select distinct (f.Realisateur) from FILMS f", $id);
				
				echo "<select name='REALISATEUR' size='1'>";
				echo "<option selected='selected'>indifférent</option>";
				if($rep != 0)  {
  			while ($realisateur_tmp = mysql_fetch_object($rep)) 
    			echo "<option>$realisateur_tmp->Realisateur</option>";
				}	
				echo "</select>";
 				?>
 				
 				
 				</div>
 
 				<div style="border-radius:5px;margin:auto; margin-left:31%;color:green; text-shadow : 5px 5px 5px green;">Acteur : <?php
 				
  			
  			/* Première version
				$id = mysql_pconnect("localhost", "video43", "2223");
				if ($id == 0) {
  				echo "Erreur de connexion au serveur MySQL";
  				exit;
				}
				if (mysql_select_db("video43", $id) == 0) {
  				echo "Erreur d'accès à la base video43";
  				exit;
				}

				$id_rep = mysql_query("select distinct (a.Acteur) from ACTEURS a", $id);

				echo "<select name='ACTEUR' size='1'>";
				echo "<option selected='selected'>indifférent</option>";
				if($id_rep != 0)  {
  				while ($acteur_tmp = mysql_fetch_object($id_rep)) 
    			echo "<option>$genre_tmp->Acteur</option>";
				}	
				echo "</select>";
				*/
				
				// Version Outils.inc
				
				$id=DB_connect();
				
				$rep=DB_execSQL("select distinct (a.Acteur) from ACTEURS a", $id);
				
				echo "<select name='ACTEUR' size='1'>";
				echo "<option selected='selected'>indifférent</option>";
				if($rep != 0)  {
  				while ($acteur_tmp = mysql_fetch_object($rep)) 
    			echo "<option>$acteur_tmp->Acteur</option>";
				}	
				echo "</select>";
				
 				?>
 				</div>

 				<input type="submit" name="envoie" value="Go" style="margin:auto;margin-left:45%; border-radius:5px;box-shadow : 3px 3px 3px green;" >
 			</fieldset>
 		</form>
 	</body>
</html>

<html>
<head>
<title>Descriptif d'un film</title>
</head>


<body>

	<?php 
		include 'Outils.inc'; 
		echo banniere("Descriptif.php", "Ikhlef & Blaszkiewicz"); 
		$id = DB_connect();
		$tab= DB_execSQL("select count(*) from FILMS", $id);
		$nb_films = mysql_result($tab,0);
		
	$n = $_POST["NUMEROFILM"];
	if (isset($n) && is_numeric($n) && $n>=1 && $n<=$nb_films) {
		
 	  $rep = DB_execSQL("select * from FILMS f where f.NoFilm='$n'", $id);

  	$film = mysql_fetch_object($rep);     //il n'y en a qu'un
  		if($film != null) {
    		echo "<table>";
   			echo "<tr><td>Numéro : </td><td>" . $film->NoFilm . "</td></tr>";
    		echo "<tr><td>Titre : </td><td>" . $film->Titre . "</td></tr>";
    		echo "<tr><td>Nationalité : </td><td>" . $film->Nationalite . "</td></tr>";
   		 	echo "<tr><td>Réalisateur : </td><td>" . $film->Realisateur . "</td></tr>";
    		echo "<tr><td>Année : </td><td>" . $film->Annee . "</td>";
    		echo "<td> Couleur : </td><td>". $film->Couleur . "</td>";
    		echo "<td>Durée : </td><td>" . $film->Duree . "minutes</td></tr>";
    		echo "<tr><td>Résumé : </td><td colspan=4>" . $film->Synopsis . "</td></tr>";
    		echo "<tr><td>Genre : </td><td>" . $film->Genre . "</td></tr>";

    		$rep2 = DB_execSQL("select a.Acteur from ACTEURS a , FILMS f where f.NoFilm='$n' and a.NoFilm = f.NoFilm", $id);

    		echo "<tr><td>Acteurs : </td><td><ul>";
    		while ($act = mysql_fetch_object($rep2)) {
      	echo "<li>$act->Acteur</li>";
    		}
    
    		echo "</ul></td></tr></table>";
    		
    		//bouton d'ajout à la selection
    		echo '<h1 style="text-align : center; "><form method="POST" action="AjoutSelection.php" target="Panier">';
    		echo '<input type="hidden" name="NoFilm" value="'.$film->NoFilm.'" />';
    		echo '<input type="submit" value="AjoutSelection"/>';
    		
    		//bouton pour voir la sélection
    		echo '</form></h1><h1 style="text-align : center; "><form method="POST" action="VoirSelection.php" target="Panier" >';
    		echo '<input type="submit" value="VoirSelection"/></form></h1>';
   		  }
      	else{
    			   echo "<h1 style='text-align:center;'>Votre requête ne donne aucun résultat.</h1>";
   		 			 echo "<p style='text-align : center; '><a href='AccueilDescriptif.php'>Retour à l'accueil de description</a></p>";
				}
		}else{
			echo "<h1 style='text-align:center;'>Veuillez entrer un numéro de film valide.</h1>";
   		echo "<p style='text-align : center; '><a href='AccueilDescriptif.php'>Retour à l'accueil de description</a></p>";		
   	}
		?>


</body>
</html>

<html>
<head>
   <title>Retour</title>
   </head>
   <body>
   <?php 
   include '../CLIENT/Outils.inc'; 
?>

<?php

$id = DB_connect();

if(!$_POST["NUMEROFILM"]=="" || !$_POST["NUMEROFILM"]==""){
$n_film = $_POST["NUMEROFILM"];
$n_exemp = $_POST["NUMEROEXEMPLAIRE"];



$tab= DB_execSQL("select count(*) from FILMS", $id);
$nb_films = mysql_result($tab,0);

$tab2= DB_execSQL("select count(NoExemplaire) from CASSETTES where NoFilm='$n_film'", $id);
$nb_exemplaires = mysql_result($tab2,0);
		//echo "nb exemplaire ". $nb_exemplaires ;
 		//echo "nb film ". $nb_films ;
//test sur la saisie du numéro de film : doit être compris entre 1 et le nombre max de films
if(!(is_numeric($n_film) && $n_film >= 1 && $n_film <= $nb_films)) {
	echo "<h1 style='text-align:center;'>Votre saisie de numéro de film n'est pas valide, cette cassette n'existe pas</h1>";
 	echo "<p style='text-align : center; '><a href='AccueilRetour.php'>Faire une autre saisie</a></p><hr/>";
 	}else{
 		//test sur la saisie du numéro d'exemplaire : doit être compris entre 1 et le nombre max d'exemplaires pour le film correspondant
 		
 		if(!($n_exemp >= 1 && $n_exemp <= $nb_exemplaires)) {
 				echo "<h1 style='text-align:center;'>Votre saisie de numéro d'exemplaire n'est pas valide, cette cassette n'existe pas</h1>";
 				echo "<p style='text-align : center; '><a href='AccueilRetour.php'>Faire une autre saisie</a></p><hr/>";
 		
 		}else{
 		
			//test dans la table EMPRES
			$rep = DB_execSQL("select * from EMPRES e,CASSETTES c where e.NoFilm=$n_film and e.NoExemplaire=$n_exemp and c.NoFilm=e.NoFilm and c.NoExemplaire=e.NoExemplaire and c.Statut='empruntee'", $id);
			if(mysql_fetch_object($rep)) {

  		//mise à jour de la table CASSETTES
  		$rep = DB_execSQL("update CASSETTES set Statut='disponible' where NoFilm=$n_film and NoExemplaire=$n_exemp", $id);
  
  		//mise à jour de la table ABONNES
  		$rep = DB_execSQL("select a.NbCassettes, a.Code from ABONNES a, EMPRES e where a.Code=e.CodeAbonne and e.NoFilm=$n_film and e.NoExemplaire=$n_exemp", $id);
  		$tmp = mysql_fetch_object($rep);
  		$nb_cassettes = intval($tmp->NbCassettes)-1;
  		$code = $tmp->Code;

  		$rep = DB_execSQL("update ABONNES set NbCassettes=$nb_cassettes where Code='$code'", $id);
  		//mise à jour de la table EMPRES
  		$rep = DB_execSQL("delete from EMPRES where NoFilm=$n_film and NoExemplaire=$n_exemp and CodeAbonne='$code'", $id);

  		echo "<h1 style='text-align:center;'>Cassette de nouveau disponible.</h1>";
 			echo "<p style='text-align : center; '><a href='AccueilRetour.php'>Faire une autre saisie</a></p><hr/>";
		}
		else{
  		echo "<h1 style='text-align:center;'>La cassette n'est pas empruntée.</h1>";
 			echo "<p style='text-align : center; '><a href='AccueilRetour.php'>Faire une autre saisie</a></p><hr/>";  		
  	}
  }
}
}else{

	echo "<h1 style='text-align:center;'>Votre saisie n'est pas correcte, il manque un/des paramètre(s).</h1>";
 	echo "<p style='text-align : center; '><a href='AccueilRetour.php'>Faire une autre saisie</a></p><hr/>";
}

?>
</body>
</html>

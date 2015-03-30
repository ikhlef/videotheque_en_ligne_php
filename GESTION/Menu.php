<html>
	<head>
   	<title>Menu Admin</title>
  </head>
  <body>
  
<?php
$tab = array ("Rafik" => "123", "Paul" => "456");

	//fonction qui renvoie la baniere  

  $menudispo = "<div style='height:5%; width : auto; border-radius : 3px; background-color :green;'>";
	$menudispo .= "<ul>";
	$menudispo .="<li style='display: inline-block; list-style-type: none; margin-left: 10%; margin-top:10px;text-shadow : 3px 3px 3px red;'><a style='color : white;' href='AccueilRetour.php'>Retour de cassettes</a></li>";
	$menudispo .="<li style='display: inline-block; list-style-type: none; margin-left: 10%; margin-top:10px;text-shadow : 3px 3px 3px red;'><a style='color : white;' >Enregistrer de nouveaux abonn&eacutes</a></li>";
	$menudispo .="<li style='display: inline-block; list-style-type: none; margin-left: 10%; margin-top:10px;text-shadow : 3px 3px 3px red;'><a style='color : white;' >Modifier des fiches d'abonn&eacutes</a></li>";
	$menudispo .="<li style='display: inline-block; list-style-type: none; margin-left: 10%; margin-top:10px;text-shadow : 3px 3px 3px red;'><a style='color : white;' >Radier des abonn&eacutes</a></li>";
	
//On récupère les nom et mot de passe fournis

$NOM=$_POST["NOMADMIN"];
$PASSADMIN=$_POST["PASSADMIN"];

//On vérifie paramètres

if(isset($tab[$NOM]) && $tab[$NOM]==$PASSADMIN){
	echo $menudispo;
  //echo "<ul><li><a href='AccueilRetour.php'>Retour de cassettes</a></li><li>Enregistrer de nouveaux abonnés</li><li>Modifier des fiches d'abonnés</li><li>Radier des abonnés</li></ul>";
}else
  echo "<h1 style='text-align : center; '><b>&#9888; Votre identification a échouée &#9888</b></span></h1> <p style='text-align : center; '><a href='index.html'><font size=4>Retour à l'identification</font></a></p>";
?>

	</body>
</html>

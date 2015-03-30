<html>
	<head>
   	<title>Résultat de la recherche</title>
	</head>
	<body>

	<?php 
		include 'Outils.inc'; 
		echo banniere("Recherche.php", "Ikhlef & Blaszkiewicz"); 
// recuperation des donnés saisies dans le formulaire
$titre = $_POST["TITRE"];   
$support = $_POST["SUPPORT"];
$dispo = $_POST["DISPO"];
$genre = $_POST["GENRE"];
$realisateur = $_POST["REALISATEUR"];
$acteur = $_POST["ACTEUR"];

$bool = false;

//on crée la requête SQL à partir de la saisie précédente : on teste les différents cas, et on construit la requête

$requete = "select distinct (f.Titre), f.Realisateur, f.Annee, f.NoFilm, f.Nationalite, f.Genre from FILMS f , CASSETTES c , ACTEURS a";

//pour le titre, on utilise explode (qui crée le tableau $titrepartiel avec pour élément chaque mot saisi), et on crée la requête avec une expression régulière
$nb_mots=str_word_count($titre);

if ($titre != "")  {  
	if($nb_mots==0){
	//rien faire, pas un critere de selection dans la requete
	}else{
  	if($bool)
    	$requete .= "and ";
 	 	else {
    	$requete .= " where ";
    	$bool = true;
  	}
		$titrepartiel = explode(" ", $titre, $nb_mots); // explode renvoie un tableau de chaines de taille $nb_mots , chacune d'elle étant une sous-chaîne du paramètre $titre
	
 /* $requete .= "f.Titre LIKE '%$titrepartiel[0]%'"; 
  foreach ($titrepartiel as $value){
  	$requete .= "or f.Titre LIKE'%$value%'";
  }
  */
  
  	$requete .= "f.Titre REGEXP '$titrepartiel[0]";   // f.titre prend une valeur parmis celle specicifiees par la regexp
  	for ($n = 1; $n < count($titrepartiel); $n++){
  		$requete .= "|$titrepartiel[$n]";
 	 }
  	$requete .= "'";
}
}

if ($genre!= "indifférent") {  
  if($bool)
    $requete .= "and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.Genre = '$genre' "; 
}

if ($realisateur!= "indifférent") {
  if($bool)
    $requete .= "and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.Realisateur = '$realisateur' "; 
}

if ($support != "indifférent") { 
  if($bool)
    $requete .= "and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.NoFilm = c.NoFilm and c.Support = '$support' "; 
}

if ($dispo != "indifférent") {
  if($bool)
    $requete .= "and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.NoFilm = c.NoFilm and c.Statut = '$dispo' "; 
}

if ($acteur != "indifférent") {
  if($bool)
    $requete .= "and ";
  else {
    $requete .= " where ";
    $bool = true;
  }
  $requete .= "f.NoFilm = a.NoFilm and a.Acteur = '$acteur' ";
} 

$id = DB_connect();
$rep = DB_execSQL($requete, $id);

echo "<h1>Résultat de la recherche :</h1>";

$tmp = mysql_fetch_object($rep);

		//test sur le résultat
	if ($tmp==null) {
		echo "<p><font size='5'>Aucun Résultat trouvé.</font></p>";
	}
	
		//si résultat non nul, création d'un tableau contenant les résultats
	else{
		echo "<table border ='1'><th>Numéro</th><th>Titre</th><th>Nationalite</th><th>Realisateur</th><th>Annee</th><th>Genre</th><th>Acteurs</th><th>Ajouter à la sélection?</th>";
		
		//traitement pour le 1er résultat
		echo "<tr>";
  	echo "<td> $tmp->NoFilm</td>";
  	echo "<td> $tmp->Titre</td>";
 		echo "<td> $tmp->Nationalite</td>";
  	echo "<td> $tmp->Realisateur</td>";
  	echo "<td> $tmp->Annee</td>";
  	echo "<td> $tmp->Genre</td>";
  	
  	$rep2 = DB_execSQL("select a.Acteur from ACTEURS a where a.NoFilm=$tmp->NoFilm", $id);
  	echo "<td><ul>";
  	while($tmp2 = mysql_fetch_object($rep2)){
  		echo "<li> $tmp2->Acteur </li>" ;
 	 	}
  	echo "</ul></td>";
  	echo "<td>";
  	echo '<form method="POST" action="AjoutSelection.php" target="Panier">';
 	 	echo '<input type="hidden" name="NoFilm" value="'.$tmp->NoFilm.'" />';
  	echo '<input type="submit" value="AjoutSelection"/></form></td>';
 	 	echo "</tr>";
 	 
 	 	//on traite les autres résultats
		while ($tmp = mysql_fetch_object($rep)) {
	
  	echo "<tr>";
  	echo "<td> $tmp->NoFilm</td>";
  	echo "<td> $tmp->Titre</td>";
 		echo "<td> $tmp->Nationalite</td>";
  	echo "<td> $tmp->Realisateur</td>";
  	echo "<td> $tmp->Annee</td>";
  	echo "<td> $tmp->Genre</td>";
  	$rep2 = DB_execSQL("select a.Acteur from ACTEURS a where a.NoFilm=$tmp->NoFilm", $id);
  	echo "<td><ul>";
  	while($tmp2 = mysql_fetch_object($rep2)){
  		echo "<li> $tmp2->Acteur </li>" ;
 	 }
  	echo "</ul></td>";
  	
  	//ajout d'un bouton pour le sélection
  	echo "<td>";
  	echo '<form method="POST" action="AjoutSelection.php" target="Panier">';
  	echo '<input type="hidden" name="NoFilm" value="'.$tmp->NoFilm.'" />';
  	echo '<input type="submit" value="AjoutSelection"/></form></td>';
  	echo "</tr>";
	}
		echo "</table>";
	}
	
	//bouton pour voir la sélection en cours
	echo '<h1 style="text-align : center; "><form method="POST" action="VoirSelection.php" target="Panier">';
echo '<input type="submit" name="VoirSelection" value="VoirSelection"/></form></h1>';

?> 
  </body>
 </html>

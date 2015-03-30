<html>
<head>

  <title>Panier</title>
  </head>
  <body>
    <hr />
  
<?php 
include 'Outils.inc';

$n_film = $_POST["NoFilm"];

	//si le cookie selection existe deja, on incrémente le premier élément de 1, et on ajoute le numero du film à la fin 
if(isset($_COOKIE['selection'])) {

		$bool=true;
	//test si le film a déjà été sélectionné
	for ($i=1 ; $i<=$_COOKIE['selection'][0] ; $i++){
		if($n_film == $_COOKIE['selection'][$i]){
			$bool=false;
		}
	}
	
	if ($bool==false){
		$reponse="Film déjà ajouté";
	}else{
  $nb = $_COOKIE['selection'][0] +1;
  setcookie('selection[0]', $nb);
  setcookie("selection[$nb]", $n_film);
  $reponse="Film ajouté à la selection";
	}
}

	//sinon, création du cookie avec un seul film
else {
  setcookie('selection[0]',1);
  setcookie('selection[1]',$n_film);
  $reponse="Film ajouté à la selection";
}

echo "<p>$reponse</p>";
/*bouton pour voir la sélection
echo '<h1 style="text-align : center; "><form method="POST" action="VoirSelection.php" target="Panier">';
echo '<input type="submit" name="VoirSelection" value="VoirSelection"/></form></h1>';*/
?>
  
  </body>
</html>


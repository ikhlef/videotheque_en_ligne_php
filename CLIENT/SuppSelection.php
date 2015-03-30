<?php 
include 'Outils.inc';

$tmp ="";

  //si le cookie selection existe et qu'il est rempli avec au moins un film
if(isset($_COOKIE['selection']) && $_COOKIE['selection'][0] > 0) {
  $nb = $_COOKIE['selection'][0];
  $ind=1;
  
  //pour toutes les cases non cochées à la page précedente, mise a jour dans le cookie
  for($var = 1; $var <= $nb; $var++){
    if(!isset($_POST["Case".$var])) {
      $n_film = $_COOKIE['selection'][$var];
      setcookie("selection[".$ind."]", $n_film);
      $ind++;
    }
  }
  
  //on ajuste le nombre total de films
  setcookie('selection[0]', $ind-1);
  $tmp = "Il y a ".($nb-($ind-1))." film(s) supprimé(s).";
}
else 
  $tmp = "Aucun film ajouté";

?>

<html>
<head>

  <title>Panier</title>
  </head>
  <body>
  <hr />
  <?php
  echo $tmp;
  //bouton pour voir la sélection
echo '<h1 style="text-align : center; "><form method="POST" action="VoirSelection.php" target="Panier">';
echo '<input type="submit" name="VoirSelection" value="VoirSelection"/></form></h1>';
?>
</body>
</html>


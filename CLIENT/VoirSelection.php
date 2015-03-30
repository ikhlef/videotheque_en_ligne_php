<?php 
include 'Outils.inc';

$id = DB_connect();
$tmp ="";

  
if(isset($_COOKIE['selection']) && $_COOKIE['selection'][0] > 0) {
  $nb = $_COOKIE['selection'][0];
  $tmp.= '<form method="POST" action="SuppSelection.php"><ul>'; 
  for($var =1;$var <=$nb;$var++) {
    $n_film = $_COOKIE['selection'][$var];
    $rep = DB_execSQL("select * from FILMS where NoFilm='$n_film'", $id);
    $film = mysql_fetch_object($rep);
    $tmp.="<li><u>$film->NoFilm</u> : <i>$film->Titre</i>  ";
    $tmp.='<input type="checkbox" name="Case'.$var.'" />';
    $tmp.="</li>";
  }
  $tmp.= '<input type="submit" value="SupprimerSelection"/>';
  $tmp.= "</ul></form>";
  $tmp.= '<form method="POST" action="ViderSelection.php">';
  $tmp.= '<input type="submit" value="ViderSelection"/></form>';
/*
  //bouton de suppression de la selection
  $tmp.= '<input type="submit" value="SupprimerSelection"/>';
  $tmp.= "</ul></form>";
  
  //bouton pour vider la selection
  $tmp.= '<form method="POST" action="ViderSelection.php">';
  $tmp.= '<input type="submit" value="ViderSelection"/></form>';*/
}
else {
  $tmp = "Aucun film sélectionné";
}
?>

<html>
<head>
  <title>Panier</title>
  </head>
  <body>
  <hr />
  <?php
  echo $tmp;
?>
  </body>
  </html>


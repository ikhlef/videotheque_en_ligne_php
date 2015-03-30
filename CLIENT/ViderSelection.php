<?php 
include 'Outils.inc';

$tmp ="";

  
if(isset($_COOKIE['selection']) && $_COOKIE['selection'][0] > 0) {
  setcookie('selection[0]', 0);
  $tmp = "Panier vidé.";
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
?>
</body>
</html>


<?php 
include 'Outils.inc';
echo banniere("Logout.php", "Ikhlef &amp; Blaszkiewicz"); 

//création d'un nouveau cookie vide , tableau associatif, initialisation
setcookie('identite[nom]');
setcookie('identite[code]');
?>

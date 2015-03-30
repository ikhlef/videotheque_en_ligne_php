<?php 
include 'Outils.inc';
$tmp =0;

$id = DB_connect();

/* On distingue 3 cas: *$tmp=2 si présence de cookie identite ou bonne identification du user
											 *$tmp=1 si les nom et pass sont incorrects
											 *$tmp=0 si les paramètres n'ont pas été renseigné
*/ 
											 				
//on teste le cookie identite : si l'utilisateur s'est identifié

if(isset($_COOKIE['identite']) && $_COOKIE['identite']['nom']!="") {
	    $nom = $_COOKIE['identite']['nom'];
      $pass = $_COOKIE['identite']['code'];
      $rep = DB_execSQL("select * from ABONNES a where a.Code='$pass' and a.Nom='$nom'", $id);
      $abo = mysql_fetch_object($rep);
      $tmp=2;
}

//sinon on recupère les informations du formulaire et on initialise le cookie identite

else{
if(isset($_POST["NOM"])) {
  $nom = $_POST["NOM"];
  $pass = $_POST["PASS"];

	
  if($nom != "" && $pass != "") {
    $rep = DB_execSQL("select * from ABONNES a where a.Code='$pass' and a.Nom='$nom'", $id);
    $abo = mysql_fetch_object($rep);

    if($abo != null) { 
      $tmp =2;
      setcookie('identite[nom]', $nom);    // intialisation du cookie identité lorsqu il est vide
      setcookie('identite[code]', $pass);
    }
    else {
      $tmp= 1;
    }
  }
      else{
      $tmp=0;

   		 }
}
}

?>

<html>
<head>
  <title>Commande</title>
  </head>
  <body>
  <?php 
  echo banniere("Commande.php", "Ikhlef &amp; Blaszkiewicz"); 
  
if ($tmp==0){
    	 echo "<h1 style='text-align:center;'>Param&egrave;tre(s) non renseign&eacute;(s).</h1>";
   		 echo "<p style='text-align : center; '><a href='IdentificationC.php'>Retour à l'identification</a></p>";
}

if($tmp==1){
  echo "<h1 style='text-align:center;'>Identification incorrecte.</h1>";
  echo "<p style='text-align : center; '><a href='IdentificationC.php'>Retour &agrave; l'identification</a></p>";
  }
  
if($tmp==2) {

      	$rep = DB_execSQL("select NbCassettes from ABONNES where Code='$pass' and Nom='$nom'", $id);
     		$nb_cas = 3 - mysql_fetch_object($rep)->NbCassettes;
	  
      	echo "<p>Vous pouvez emprunter encore $nb_cas cassettes.</p>";

      	if($nb_cas > 0) {
		echo '<form method="POST" action="ConfirmeCommande.php">';
		echo '<input type="hidden" name="NB_CASSETTES" value="'.$nb_cas.'"/>';
		echo '<input type="hidden" name="NOM" value="'.$nom.'"/>';
		echo '<input type="hidden" name="PASS" value="'.$pass.'"/>';
		
		echo '<table><tr><th>N°Film</th><th>Support</th></tr>';
	for($var = 1;$var <= $nb_cas; $var++) {
	  echo '<tr><td><input type="input" placeholder="N°Film" name="NumFilm'.$var.'" /></td>';
	  echo '<td><input type="radio" name="Support'.$var.'" value="DVD" checked />DVD | ';
	  echo '<input type="radio" name="Support'.$var.'" value="VHS" />VHS</td></tr>';
	}
	echo '</table>';
	echo '<input type="submit" value="Commander" />';
	echo '</form>';
      }
    } 

?>
</body>
</html>

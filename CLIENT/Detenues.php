<?php 	 
				include 'Outils.inc';
$tmp =0;

$id = DB_connect();

/* On distingue 3 cas: *$tmp=2 si présence de cookie identite ou bonne identification du user
											 *$tmp=1 si les nom et pass sont incorrects
											 *$tmp=0 si les paramètres n'ont pas été renseignés
*/

// Test sur le cookie identite, effectué une recherche si l abonne est bien present dans le cookie
if(isset($_COOKIE['identite']) && $_COOKIE['identite']['nom']!="") {
	    $nom = $_COOKIE['identite']['nom'];
      $pass = $_COOKIE['identite']['code'];
      $rep = DB_execSQL("select * from ABONNES a where a.Code='$pass' and a.Nom='$nom'", $id);
      $abo = mysql_fetch_object($rep);
      $tmp=2;
}

//Sinon on prend les valeurs du formulaire de Identification.php , effectuer la recherche avec les valeurs recuperer depusi le formulaire de saisie idemtificationD.php, stocké dans la variable d environnement $_POST

else{
if(isset($_POST["NOMABONNE"])) {      
  $nom = $_POST["NOMABONNE"];
  $pass = $_POST["NUMEROABONNE"];

  if($nom != "" && $pass != "") {
    $rep = DB_execSQL("select * from ABONNES a where a.Code='$pass' and a.Nom='$nom'", $id);
    $abo = mysql_fetch_object($rep);

    if($abo != null) { 
      $tmp =2;
      setcookie('identite[nom]', $nom);
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
		<title>Cassettes détenues</title>
	</head>

	<body>
<?php
echo banniere("Detenues.php", "Ikhlef & Blaszkiewicz");

if($tmp==0){
    	 echo "<h1 style='text-align:center;'>Paramètre(s) non renseigné(s).</h1>";
   		 echo "<p style='text-align : center; '><a href='IdentificationD.php'>Retour à l'identification</a></p>";
}

if($tmp==1){
  echo "<h1 style='text-align:center;'>Identification incorrecte</h1>";
  echo "<p style='text-align : center; '><a href='IdentificationD.php'>Retour à l'identification</a></p>";
  }
  


 if($tmp==2) {
    
    
    if(($abo->NbCassettes) == 0){   
      echo "<h1 style='text-align:center;'>Vous ne possédez aucune cassette.</h1>";    
      }
      
    else {
      $requete = "select c.NoFilm, c.NoExemplaire, f.Titre, f.Realisateur, e.DateEmpRes from FILMS f, CASSETTES c, EMPRES e where e.CodeAbonne='$abo->Code' and f.NoFilm=c.NoFilm and c.NoFilm=e.NoFilm and c.NoExemplaire=e.NoExemplaire and c.Statut='empruntee'";
      //echo $requete;
      $rep = DB_execSQL($requete, $id);
      echo "<h2>Cassettes détenues :</h2>";
      while($tmp = mysql_fetch_object($rep)) {
	$date = $tmp->DateEmpRes;
	echo "<ul><li><i>Film n° : </i>$tmp->NoFilm | <i>Exemplaire n° : </i>$tmp->NoExemplaire</li><li><i>Titre : </i>$tmp->Titre</li><li><i>Realisateur : </i>$tmp->Realisateur</li><li><i>Date d'emprunt : </i>$date</li></ul>";
      }
    }  
}

    
?>

	</body>
</html>

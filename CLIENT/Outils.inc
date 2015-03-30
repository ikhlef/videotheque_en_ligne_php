<?php

	
//Creation d'un tableau $tab pour stocker les différentes pages en fonction de la présence de cookies ou non

if(isset($_COOKIE['identite']) && $_COOKIE['identite']['nom']!=""){
  $tab = array("Accueil.php" => "Accueil", "AccueilDescriptif.php" => "Descriptif d'un film", "AccueilRecherche.php" => "Recherche de films", "Commande.php" => "Commande de cassettes", "Detenues.php" => "Liste des cassettes détenues", "Logout.php" => "Logout");
}
else{
  $tab = array("Accueil.php" => "Accueil", "AccueilDescriptif.php" => "Descriptif d'un film", "AccueilRecherche.php" => "Recherche de films", "IdentificationC.php" => "Commande de cassettes", "IdentificationD.php" => "Liste des cassettes détenues");
}
 
//Fonction banniere

function banniere($page, $auteurs) {
  global $tab;
  $text = "<div style='background:url(fleur.jpg) repeat; width : auto; border-radius:20px;'>
  			<hr color='green'/><h1 style='text-align : center; color:white; text-shadow : 3px 3px 3px green; '>
  					<font size=7><b>VideoEXPRESS</b></font></h1>
  						<p style='text-align : center;color:white; text-shadow : 3px 3px 3px green;'>&copy; $auteurs</p>
  			<hr color='green'/>
  		</div>";
				
  $text .= "<div style='height:5%; width : auto; border-radius : 3px; background-color :green;'><ul>";; 
  foreach($tab as $tmp => $val) {
    if($tmp != $page)
      $text .= "<li  style='display: inline-block; list-style-type: none; margin-left: 7%; margin-top:10px;text-shadow : 3px 3px 3px blue;'><a style='color : white;' href=$tmp><font size=4>$val</font/></a></li>";
  }
  $text .= "</ul></div>";
  return $text;
}

//Fonction DB_connect()

function DB_connect() {
  $cnx = mysql_pconnect("localhost", "video43", "2223");
  if ($cnx == 0) {
    echo "Erreur de connexion au serveur MySQL";
    exit;
  } else {
    if (mysql_select_db("video43", $cnx) == 0) {
      echo "Erreur d'accès à la base video43";
      exit;
    }
  }
  return $cnx;  
}

//Fonction DB_execSQL

function DB_execSQL($req, $serv) {
	  $rep = mysql_query($req, $serv);
  if ($rep != 0 )
    return $rep;
  else {
    echo mysql_error($serv);
    exit;
  }
}

?>

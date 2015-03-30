<html>
<head>
   <title>Confirmation de commande</title>
   </head>
   <body>
   <?php 
   include 'Outils.inc'; 
echo banniere("ConfirmeCommande.php", "Ikhlef &amp; Blaszkiewicz"); 
?>

<?php
$nom = $_POST["NOM"];
$code = $_POST["PASS"];
$nb_cas = $_POST["NB_CASSETTES"];
    
    
$id = DB_connect();
    
    


$bool=false;

	for($var=1;$var<=$nb_cas;$var++) {
  	$sup = $_POST["Support".$var];
  	$n_film = $_POST["NumFilm".$var];
  	
		$tab= DB_execSQL("select count(*) from FILMS", $id);
		$nb_films = mysql_result($tab,0);
		
  	if(isset($n_film) && $n_film!="") {
  		if(!(is_numeric($n_film) && $n_film >= 1 && $n_film <= $nb_films)) {
  			echo "<b>Choix numéro $var</b><br/>Votre saisie n'est pas valide<hr/>";
 		}else{
   	 $rep = DB_execSQL("select * from FILMS f where f.NoFilm='$n_film'", $id);
   	 $film = mysql_fetch_object($rep);     //il n'y en a qu'un
          
    $cassettes=null;
    $rep = DB_execSQL("select * from CASSETTES c where c.NoFilm=$n_film and c.Support='$sup' and c.Statut='disponible'", $id);
    $cassettes = mysql_fetch_object($rep);
    
    if($cassettes  == null) {
    $rep = DB_execSQL("select * from CASSETTES c, EMPRES e where c.NoFilm=$n_film and c.Support='$sup' and c.Statut='reservee' and c.NoFilm=e.NoFilm and c.NoExemplaire=e.NoExemplaire and e.DateEmpRes<DATE_SUB(NOW(), INTERVAL 5 MINUTE)", $id); 
    $cassettes = mysql_fetch_object($rep);
    }
		 

    if($cassettes  == null) {
    $rep = DB_execSQL("select * from CASSETTES c where c.NoFilm=$n_film  and c.Statut='disponible'", $id);
    $cassettes = mysql_fetch_object($rep);
    } 
    
    if($cassettes  == null) {
    $rep = DB_execSQL("select * from CASSETTES c, EMPRES e where c.NoFilm=$n_film and c.Statut='reservee' and c.NoFilm=e.NoFilm and c.NoExemplaire=e.NoExemplaire and e.DateEmpRes<DATE_SUB(NOW(), INTERVAL 5 MINUTE)", $id); 
    $cassettes = mysql_fetch_object($rep);
    }


    if($film != null) {
      echo "<table>";
      echo "<tr><td><b>Choix numéro $var<b/></td></tr><tr><td>Numéro du film : </td><td>" . $film->NoFilm . "</td></tr>";
      echo "<tr><td>Titre : </td><td>" . $film->Titre . "</td></tr>";
      echo "<tr><td>Disponibilité : </td><td>";
      if($cassettes != null) {
      	echo '<form method="POST" action="ExecuteCommande.php">';
				echo '<input type="hidden" name="Ex'.$var.'" value="'.$cassettes->NoExemplaire.'"/>';
				if($cassettes->Statut=='disponible') {
	 				 DB_execSQL("update CASSETTES set Statut='reservee' where NoFilm=".$cassettes->NoFilm." and NoExemplaire=".$cassettes->NoExemplaire, $id);
	  		   DB_execSQL("insert into EMPRES values($cassettes->NoFilm, $cassettes->NoExemplaire, '".$code."', NOW())", $id);
				}
				else
	  			 DB_execSQL("update EMPRES set CodeAbonne='".$code."', DateEmpRes=NOW() where NoFilm=$cassettes->NoFilm and NoExemplaire=$cassettes->NoExemplaire", $id);
				
			if($cassettes->Support==$sup) {
	  		echo "Oui</td></tr>";	 
	  		echo '<tr><td>Choix : </td><td><input type="checkbox" name="NumFilm'.$var.'" value="'.$film->NoFilm.'" checked/></td></tr>';
	  		$bool=true;
			}
			else {
	  		echo "Oui mais en ".$cassettes->Support."</td></tr>";	 
	  		echo '<tr><td>Choix : </td><td><input type="checkbox" name="NumFilm'.$var.'" value="'.$film->NoFilm.'" /></td></tr>';
	  		$bool=true;
			}
     }
     else 
			echo "Non</td></tr>";
      echo "</table>";
      echo "<hr/>";
    }
  }
}
}

echo '<input type="hidden" name="NB_CAS" value="'.$nb_cas.'"/>';
echo '<input type="hidden" name="PASS" value="'.$code.'"/>';
if($bool==true){
echo '<input name="commander" type="submit" value="Commander"/></form>';
}
echo '<form method="POST" action="Commande.php">';
echo '<input type="hidden" name="NOM" value="'.$nom.'"/>';
echo '<input type="hidden" name="PASS" value="'.$code.'"/>';
echo '<input type="submit" value="Revoir le choix"/>';
echo '</form>'; 
    
?>
</body>
</html>

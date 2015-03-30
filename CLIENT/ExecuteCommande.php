<html>
<head>
   <title>Finalisation</title>
   </head>
   <body>
   <?php 
   include 'Outils.inc'; 
echo banniere("ExecuteCommande.php", "Ikhlef &amp; Blaszkiewicz"); 
?>
        
<?php
$code = $_POST["PASS"];
$nb_cas = $_POST["NB_CAS"];    
    
$id = DB_connect();

$cpt = 0;
for($var =1; $var<=$nb_cas; $var++) {
  if(isset($_POST["NumFilm".$var])) {
    $cpt++;
    $n_film = $_POST["NumFilm".$var];
    $n_ex = $_POST["Ex".$var];

    if($n_film != null) {

      $rep = DB_execSQL("select * from EMPRES where CodeAbonne='".$code."' and NoFilm=".$n_film." and NoExemplaire=".$n_ex." and DateEmpRes>DATE_SUB(NOW(), INTERVAL 5 MINUTE)", $id);
				
      if(mysql_fetch_object($rep)) {
	$rep =DB_execSQL("select * from CASSETTES where NoFilm=$n_film and NoExemplaire=$n_ex and Statut!='empruntee'", $id);
	if(mysql_fetch_object($rep)) {
	  DB_execSQL("update CASSETTES set Statut='empruntee' where NoFilm=".$n_film." and NoExemplaire=".$n_ex, $id);
	  DB_execSQL("update ABONNES set NbCassettes=NbCassettes+1 where Code='".$code."'", $id);
   	}
      }
      else {
	echo "<p>TimeOut</p>";
	exit;
      }
    }
  }
}
if($cpt >0)
  echo "<p>Commande effectuée</p>"; 
else
  echo "<p>Vous n'avez rien commandé</p>";
  
?>
</body>
</html>

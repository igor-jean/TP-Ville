<?php 
require_once "header.php";
require_once "bd.php" ;
$requete = $bdd->prepare("insert into villes_france_free(ville_departement, ville_nom) values(:dep, :ville)");
$requete->bindParam(":dep", $dep,PDO::PARAM_INT);
$requete->bindParam(":ville", $ville,PDO::PARAM_STR);
$dep = $_GET["dep"];
$ville = $_GET["ville"];
$requete->execute();
require_once "footer.php";
echo "La ville ".$ville."(".$dep.") a été ajouté à la base de donnée.";
?>

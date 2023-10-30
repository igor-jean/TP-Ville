<?php
require_once "header.php";
require_once "bd.php";
$id = $_GET["id"];
$dep = $_GET["dep"];
$req = $bdd->prepare("update villes_france_free set ville_departement= :dep where ville_id= :id");
$req->bindParam(":dep", $dep, PDO::PARAM_STR);
$req->bindParam(":id", $id, PDO::PARAM_INT);
$req->execute();
echo "Le departement à bien été modifié.";
?>
<?php require_once "footer.php"; ?>
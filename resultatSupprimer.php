<?php
require_once "header.php";
require_once "bd.php";
$id = $_GET["id"];
$req = $bdd->prepare("delete from villes_france_free where ville_id='$id'");
$req->execute();
echo "Le departement à bien été supprimé.";
?>
<?php require_once "footer.php"; ?>
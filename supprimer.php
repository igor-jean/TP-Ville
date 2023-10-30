<?php
require_once "header.php";
require_once "bd.php";
$id = $_GET["id"];
$req = $bdd->prepare("select ville_departement, ville_nom from villes_france_free where ville_id='$id'");
$req->execute();
foreach($req as $infos){
    $dep = $infos["ville_departement"];
    $ville = $infos["ville_nom"];
}
?>
<form action="resultatSupprimer.php" method="get">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    Departement : 
    <input type="text" readonly="readonly" name="dep" value="<?php echo $dep ?>">
    Ville :
    <input type="text" readonly="readonly" name="ville" value="<?php echo $ville ?>">
    <input type="submit" value="Supprimer">
</form>
<?php require_once "footer.php"; ?>
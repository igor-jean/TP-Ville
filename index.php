<?php
require_once "header.php";
require_once "bd.php";
// PAGINATION
$pageActuelle = isset($_GET["page"])?$_GET["page"]:1;
$sql = "SELECT COUNT(*) as ville_id from villes_france_free ";
$query = $bdd->prepare($sql);
$query->execute();
$result = $query->fetch();
$nbArticle = (int) $result["ville_id"];
$parPage = isset($_GET["nbl"])?$_GET["nbl"]:10;
$pages = ceil($nbArticle / $parPage);
$premier = ($pageActuelle * $parPage) - $parPage;
// REQUETE TABLEAU VILLE
$req = $bdd->prepare("select ville_id, ville_departement, ville_nom from villes_france_free order by ville_id desc limit :premier, :parpage");
$req->bindValue(':premier', $premier, PDO::PARAM_INT);
$req->bindValue(':parpage', $parPage, PDO::PARAM_INT);
$req->execute();
$articles = $req->fetchAll(PDO::FETCH_ASSOC);
?>
<table>
        <tr>
            <th>Departement</th>
            <th>Ville</th>
        </tr>
<?php
foreach ($articles as $infos) {
    echo"
        <tr>
            <td>".$infos['ville_departement']."</td>
            <td>".$infos['ville_nom']."<a href='modifier.php?id=".$infos["ville_id"]."'>Modifier le code postal</a> <a href='supprimer.php?id=".$infos["ville_id"]."'>Supprimer</a></td>
        </tr>"
    ;
}
?>
</table>
<nav>
    <ul class="pagination">
        <?php if ($pageActuelle > 1): ?>
            <li>
                <a href="./?page=<?= $pageActuelle - 1; echo "&nbl=$parPage";?>" >Précédente</a>
            </li>
        <?php endif; ?>
        <?php if ($pageActuelle < $pages): ?>
            <li>
                <a href="./?page=<?= $pageActuelle + 1; echo "&nbl=$parPage"; ?>" >Suivante</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<form action="index.php" method="get">
    <select name="nbl" id="nbl">
        <option value="10" <?= ($parPage == 10);if($parPage==10){echo "'selected'";} ?> >10</option>
        <option value="25" <?= ($parPage == 25);if($parPage==25){echo "'selected'";} ?>>25</option>
        <option value="50" <?= ($parPage == 50);if($parPage==50){echo "'selected'";} ?>>50</option>
        <option value="100"<?= ($parPage == 100);if($parPage==100){echo "'selected'";} ?>>100</option>
    </select>
    <input type="submit" value="Rafraichir la page">
</form>
<?php require_once "footer.php" ;?>
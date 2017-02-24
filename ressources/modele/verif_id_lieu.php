<?php
    $id_lieu=$_GET["id_lieu"];
    require("connexion_sql.php");
    $req = $bdd->prepare("SELECT id_lieu FROM lieu WHERE id_lieu = ?");
    $req->execute(array($id_lieu));
    $count = $req->rowCount(); // on rowCount() la requete, donc rowcount retournera une valeur si il trouve.
    $req->closeCursor();
?>

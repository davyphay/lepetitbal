<?php
if(isset($_POST["pseudo"])){
    $pseudo=$_POST["pseudo"];
    require("connexion_sql.php");
    $req = $bdd->prepare("SELECT pseudo_membre FROM membres WHERE pseudo_membre = ?");
    $req->execute(array($pseudo));
    $count = $req->rowCount(); // on rowCount() la requete, donc rowcount retournera une valeur si il trouve.
    $req->closeCursor();
    if($count == 0) // si il ne trouve pas une valeur, alors c'est bon
    {
        echo "1";
    } 
} 
else { 
    echo "Erreur!";
}
?>


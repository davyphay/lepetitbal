<?php
if(isset($_POST["email"]) || isset($_POST["email_lien_mdp"])){
    if(isset($_POST["email"])){
        $email=htmlspecialchars($_POST["email"]);
        require("connexion_sql.php");
        $req = $bdd->prepare("SELECT pseudo_membre FROM membres WHERE email_membre = ?");
        $req->execute(array($email));
        $count = $req->rowCount(); // on rowCount() la requete, donc rowcount retournera une valeur si il trouve.
        $req->closeCursor();
        if($count == 0) // si il ne trouve pas une valeur, alors c'est bon
        {
            echo "1";
        } 
    }
    else if (isset($_POST["email_lien_mdp"])){
        $email=htmlspecialchars($_POST["email_lien_mdp"]);
        require("connexion_sql.php");
        $req = $bdd->prepare("SELECT pseudo_membre FROM membres WHERE email_membre = ?");
        $req->execute(array($email));
        $count = $req->rowCount(); // on rowCount() la requete, donc rowcount retournera une valeur si il trouve.
        $req->closeCursor();
        if($count !== 0) // s'il trouve une valeur, alors c'est bon
        {
            echo "1"; 
        }
    }
} 
else { 
    echo "non non !";
}
?>


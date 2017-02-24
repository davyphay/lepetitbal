<?php
    function check_mdp_membre($email_membre,$pass_hache){
        // Recupération des données
        global $bdd;
        $req = $bdd->prepare('SELECT id_membre FROM membres WHERE email_membre = ? AND pass_membre = ?');
        $req->execute(array($email_membre, $pass_hache));
        $resultat = $req->fetch();
        $req->closeCursor();
        return $resultat;
    }
?>
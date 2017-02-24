<?php
    function connexion_membreBdd($pseudo,$pass_hache){
        // Recupération des données
        global $bdd;
        $req = $bdd->prepare('SELECT id_membre,pseudo_membre,email_membre FROM membres WHERE pseudo_membre = ? AND pass_membre = ?');
        $req->execute(array($pseudo, $pass_hache));
        $resultat = $req->fetch();
        $req->closeCursor();
        return $resultat;
    }
?>
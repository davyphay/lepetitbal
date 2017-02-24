<?php
    function check_mdp_temporaire($mdp){
        // Recupération des données
        global $bdd;
        $req = $bdd->prepare('SELECT adresse_email_temporaire FROM mdp_temporaire WHERE mdp_temporaire = ?');
        $req->execute(array($mdp));
        
        $resultat='';
        while ($donnees = $req->fetch()){
            $resultat=$donnees['adresse_email_temporaire'];
		}

        $req->closeCursor();
        return $resultat;
    }
?>
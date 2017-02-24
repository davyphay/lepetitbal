<?php
   function put_mdp_temporaire($email,$mot_de_passe_temporaire)
    {
        global $bdd;
        $req = $bdd->prepare('INSERT INTO mdp_temporaire ( adresse_email_temporaire , mdp_temporaire , date_demande_mdp_temporaire ) VALUES (:adresse_email_temporaire, :mot_de_passe_temporaire, NOW()) ON DUPLICATE KEY UPDATE mdp_temporaire=:mot_de_passe_temporaire, date_demande_mdp_temporaire=NOW()');
        $req->execute(array(
			'adresse_email_temporaire' => $email,
			'mot_de_passe_temporaire' => $mot_de_passe_temporaire,
            ));
        $req->closeCursor();
   }
?>

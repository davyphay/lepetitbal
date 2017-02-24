<?php
	//Annonceur
   function update_gestion_jeton($user_email,$nb_jetons)
    {
        global $bdd;
		//  Create new user avec nb de jeton  si user déjà dans le tableau sinon Update nombre de jetons
		$req = $bdd->prepare('INSERT INTO gestion_jeton (adresse_email_gestion_jeton, nombre_jeton_gestion_jeton, derniere_maj_gestion_jeton) VALUES (:user_email, :nb_jetons, NOW()) ON DUPLICATE KEY UPDATE nombre_jeton_gestion_jeton = nombre_jeton_gestion_jeton + :nb_jetons, derniere_maj_gestion_jeton=NOW()');

        $req->execute(array(
			'nb_jetons' => $nb_jetons,
			'user_email' =>$user_email
			));
        $req->closeCursor();
   }
?>

<?php
	//Annonceur
   function update_proprietaire_lieu($email_proprio,$nom_lieu_proprio)
    {
        global $bdd;
		//  Create new user avec nb de jeton  si user déjà dans le tableau sinon Update nombre de jetons
		$req = $bdd->prepare('UPDATE lieu SET proprietaire_adresse_email_lieu=:email_proprio WHERE nom_lieu=:nom_lieu_proprio');
        $req->execute(array(
			'email_proprio' => $email_proprio,
			'nom_lieu_proprio' =>$nom_lieu_proprio
			));
        $req->closeCursor();
   }
?>

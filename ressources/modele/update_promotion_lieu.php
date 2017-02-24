<?php
	//Annonceur
   function update_promotion_lieu($id_lieu,$email_proprietaire_lieu,$email_membre,$nb_jeton_utilise,$date_picker)
    {
        global $bdd;
		  // Update lieu
        $req = $bdd->prepare('UPDATE lieu
									  SET date_expiration_promotion_lieu=:date_expiration_promotion_lieu
									  WHERE id_lieu=:id_lieu AND proprietaire_adresse_email_lieu=:proprietaire_adresse_email_lieu');
        $req->execute(array(
			'id_lieu' => $id_lieu,
			'date_expiration_promotion_lieu' => $date_picker,
			'proprietaire_adresse_email_lieu' =>$email_proprietaire_lieu
         ));
        $req->closeCursor();
		  
		   // Update nombre de jetons restants
			$req = $bdd->prepare('UPDATE gestion_jeton
									  SET nombre_jeton_gestion_jeton = nombre_jeton_gestion_jeton - :nombre_jeton_utilise, derniere_maj_gestion_jeton=NOW()
									  WHERE adresse_email_gestion_jeton=:email_membre');
        $req->execute(array(
			'nombre_jeton_utilise' => $nb_jeton_utilise,
			'email_membre' =>$email_membre
			));
        $req->closeCursor();
   }
?>

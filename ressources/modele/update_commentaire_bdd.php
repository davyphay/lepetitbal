<?php
	//Annonceur
   function update_commentaire_bdd($id_commentaire,$contenu_commentaire)
    {
		global $bdd;
        $req = $bdd->prepare('UPDATE commentaires SET contenu_commentaire=:contenu_commentaire, datetime_commentaire=(NOW() + INTERVAL 1 HOUR) WHERE id_commentaire=:id_commentaire');
        $req->execute(array(
			'id_commentaire' => $id_commentaire,
			'contenu_commentaire' => $contenu_commentaire,
            ));
        $req->closeCursor();
   }
?>
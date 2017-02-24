<?php
   function delete_commentaire_bdd($id_commentaire)
    {
		global $bdd;
		$req = $bdd->prepare('DELETE FROM commentaires WHERE id_commentaire=:id_commentaire');
        $req->execute(array(
			'id_commentaire' => $id_commentaire,
            ));
        $req->closeCursor();
   }
?>
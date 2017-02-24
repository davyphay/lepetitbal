<?php
   function delete_evenement_bdd($id_evenement)
    {
		global $bdd;
		$req = $bdd->prepare('DELETE FROM evenement WHERE id_evenement=:id_evenement');
        $req->execute(array(
			'id_evenement' => $id_evenement,
            ));
        $req->closeCursor();
   }
?>
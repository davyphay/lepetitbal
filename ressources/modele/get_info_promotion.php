<?php
	function get_info_promotion($id_lieu) // RENVOIE 1 si promotion en cours 0 sinon
    {
        global $bdd;
        $req = $bdd->prepare(
            "SELECT date_expiration_promotion_lieu
            FROM lieu 
            WHERE id_lieu=?"
        );
        $req->execute(array($id_lieu));

        $date_expiration_promotion_lieu='';
        while ($donnees = $req->fetch()){
            $date_expiration_promotion_lieu=$donnees['date_expiration_promotion_lieu'];
		}
        $req->closeCursor();

		$today = date("Y-m-d");
		$today_dt = new DateTime($today);
		$expire_dt = new DateTime($date_expiration_promotion_lieu);
		
		if ($today_dt <= $expire_dt) {
			return 1; // promotion en cours
		}
		else{
			return 0; // pas de promotion en cours
		}
	}
?>
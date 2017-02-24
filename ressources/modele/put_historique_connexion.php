<?php
   function put_historique_connexion_membre($id_membre,$plateforme,$ip_membre,$logtype)
    {
        global $bdd;
        $req = $bdd->prepare('INSERT INTO `historique_connexion_membre`(`id_membre_historique`,`plateforme_connexion`,`ip_connexion`,`datetime_connexion`,`logtype`) VALUES (:historique_connexion_membre,:plateforme,:ip_membre,NOW(),:logtype)');
        $req->execute(array(
         'historique_connexion_membre' => $id_membre,
			'plateforme' => $plateforme,
			'ip_membre' => $ip_membre,
			'logtype' => $logtype
            ));
        $req->closeCursor();
   }
?>

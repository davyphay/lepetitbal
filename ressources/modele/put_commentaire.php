<?php
   function put_commentaire($id_lieu,$contenu,$pseudo,$adresse_mail)
    {
        global $bdd;
        $req = $bdd->prepare('INSERT INTO `commentaires`(`id_lieu_commentaire`,`contenu_commentaire`,`pseudo_commentaire`,`adresse_mail_commentaire`,`datetime_commentaire`) VALUES (:id_lieu_commentaire,:contenu_commentaire,:pseudo_commentaire,:adresse_mail_commentaire,NOW() + INTERVAL 1 HOUR)');
        $req->execute(array(
			'id_lieu_commentaire' => $id_lieu,
			'contenu_commentaire' => $contenu,
			'pseudo_commentaire' => $pseudo,
			'adresse_mail_commentaire' => $adresse_mail
            ));
        $req->closeCursor();
   }
?>

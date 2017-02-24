<?php
	//Annonceur
   function update_mdp_membre($email_membre,$pass_hache_new)
    {
		global $bdd;
        $req = $bdd->prepare('UPDATE membres SET pass_membre=:pass_membre WHERE email_membre=:email_membre');
        $req->execute(array(
			'pass_membre' => $pass_hache_new,
			'email_membre' => $email_membre,
            ));
        $req->closeCursor();
   }
;?>
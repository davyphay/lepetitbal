<?php
    function put_membreBdd($pseudo,$email,$password_membre){
        global $bdd;
        //Verification si le pseudo est déjà utilisé
        $req = $bdd->prepare("SELECT pseudo_membre FROM membres WHERE pseudo_membre =?");
        $req->execute(array($pseudo));
        $count = $req->rowCount(); // on rowCount() la requete, donc rowcount retournera une valeur si il trouve.
        $req->closeCursor();
        if($count == 0) // si il ne trouve pas une valeur, alors c'est bon
        {
            //Vérification si l'adresse mail est déjà utilisée
            $req = $bdd->prepare("SELECT email_membre FROM membres WHERE email_membre =?");
            $req->execute(array($email));
            $count = $req->rowCount(); // on rowCount() la requete, donc rowcount retournera une valeur si il trouve.
            $req->closeCursor();
            if($count == 0) // si il ne trouve pas une valeur, alors c'est bon
            {
                $req = $bdd->prepare("INSERT INTO membres(`pseudo_membre`, `pass_membre`, `email_membre`, `date_inscription_membre`) VALUES(:pseudo_membre, :pass_membre, :email_membre, CURRENT_TIMESTAMP)");
                $req->execute(array(
                    'pseudo_membre' => $pseudo,
                    'pass_membre' => $password_membre,
                    'email_membre' => $email
                ));
                $req->closeCursor();
                return 0;
            }
            else{
                return 1;
            }
        }
        else{
            return 2;
        }
    }
?>
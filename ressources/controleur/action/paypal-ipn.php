<?php
require('PaypalIPN.php');
use PaypalIPN;

$ipn = new PayPalIPN();
/*
// Use the sandbox endpoint during testing.
$ipn->useSandbox();*/
$verified = $ipn->verifyIPN();
if ($verified) {
    /*
     * Process IPN
     * A list of variables is available here:
     * https://developer.paypal.com/webapps/developer/docs/classic/ipn/integration-guide/IPNandPDTVariables/
     */
	$quantity = (int)$_POST['quantity'];
	$prix_total_paye = (int)$_POST['mc_gross'];
	$user_email=$_POST['custom'];
	$type_produit=$_POST['option_selection1'];
	$data = serialize($_POST);

	//Valeur par defaut
	$nb_jetons_produit=0;
	$prix_produit_unitaire=0;
	
	//En fonction de la grille des prix
	if($type_produit=='Pack Diamant - 500 Jetons'){
		$nb_jeton_produit=500;
		$prix_produit_unitaire=300;
	}
	else if($type_produit=='Pack Or - 200 Jetons'){
		$nb_jeton_produit=200;
		$prix_produit_unitaire=140;
	}
	else if($type_produit=='Pack Argent - 50 Jetons'){
		$nb_jeton_produit=50;
		$prix_produit_unitaire=40;
	}
	else if($type_produit=='Pack Bronze - 20 Jetons'){
		$nb_jeton_produit=20;
		$prix_produit_unitaire=18;
	}
	else if($type_produit=='Unité - 1 Jeton'){
		$nb_jeton_produit=1;
		$prix_produit_unitaire=1;
	}
	
	$nb_jetons_total= $nb_jeton_produit * $quantity;
	$prix_total_calcul = $prix_produit_unitaire * $quantity;
	if($prix_total_calcul == $prix_total_paye){
		require_once('../../modele/connexion_sql.php');  // Connexion base sql
		//On ajoute une commande au tableau (insert into)
		require_once('../../modele/put_orders.php');
		put_orders($user_email,$type_produit,$nb_jeton_produit,$prix_produit_unitaire,$quantity,$prix_total_paye,$nb_jetons_total,$data);
		
		//On met à jour le tableau des jetons (update)
		require_once('../../modele/update_gestion_jeton.php');
		update_gestion_jeton($user_email,$nb_jetons_total);

		//Envoi d'un mail de confirmation au compte crédité
		// Déclaration de l'adresse de destination.
		$mail = $user_email;
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
		{
			$passage_ligne = "\r\n";
		}
		else{
			$passage_ligne = "\n";
		}
		// Déclaration de l'adresse de réponse
		$adresse_mail_reply = "contact@lepetitbal.com";
	
		//Contenu du message
		$contenu_message ="<p>Bonjour!</p></br><p>Votre compte sur lepetitbal.com vient d'être crédité de <b>".$nb_jetons_total." jeton(s)</b> pour un montant total de <b>".$prix_total_paye." €</b>.</p><p>Vous pouvez dès à présent les utiliser à travers le site internet.</p><p>Nous vous remercions de votre confiance!</p></br><p>L'équipe de lepetitbal.com</p>";
		
		//=====Déclaration des messages au format texte et au format HTML.
		$message_txt = $contenu_message;
		$message_html = "<html><head></head><body><p>".$contenu_message."</p></body></html>";
		
		//=====Création de la boundary.
		$boundary = "-----=".md5(rand());
		$boundary_alt = "-----=".md5(rand());
		//==========
		 
		//=====Définition du sujet.
		$sujet = 'Achat de jetons';
		//=========
		 
		//=====Création du header de l'e-mail.
		$header = "From: \"Contact lepetitbal\"<contact@lepetitbal.com>".$passage_ligne;
		$header.= "Reply-to: \"".$adresse_mail_reply."\" <".$adresse_mail_reply.">".$passage_ligne;
		$header.= "MIME-Version: 1.0".$passage_ligne;
		$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
		//==========
		 
		//=====Création du message.
		$message = $passage_ligne."--".$boundary.$passage_ligne;
		$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
		$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
		
		//=====Ajout du message au format texte.
		$message.= "Content-Type: text/plain; charset=\"utf-8\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_txt.$passage_ligne;
		//==========
		 
		$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
		 
		//=====Ajout du message au format HTML.
		$message.= "Content-Type: text/html; charset=\"utf-8\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_html.$passage_ligne;
		//==========
		 
		//=====On ferme la boundary alternative.
		$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
		//==========
		
		$message.= $passage_ligne."--".$boundary.$passage_ligne;
		
		//=====Envoi de l'e-mail.
		mail($mail,$sujet,$message,$header);
	}
	else{
		//Envoi d'un mail d'information d'erreur à contact@lepetitbal.com
		// Le message
		$headers_contact = 'From: commande@lepetitbal.com'."\r\n".'Reply-To: noreply'."\r\n".'X-Mailer: PHP/'.phpversion();
		$message_contact = "L'utilisateur ".$user_email." à essayé de commander ".$nb_jetons_total." jeton(s) pour un montant total de ".$prix_total_calcul." € avec ".$prix_total_paye." €";
		// Envoi du mail
		mail('contact@lepetitbal.com', 'Commande de jetons échouée (Prix falsifié)', $message_contact, $headers_contact);
		exit();
	}
}

// Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
header("HTTP/1.1 200 OK");

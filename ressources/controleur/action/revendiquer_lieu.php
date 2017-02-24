<meta charset="utf-8">
<?php
include 'session.inc';
//Config bouton retour recherche
$bouton_retour="/cours-et-soirees-dansantes/";
if(isset ($_SESSION['recherche'])){
	if($_SESSION['recherche']=="calendrier"){
		$bouton_retour="/soirees-et-evenements-dansants/";
	}
	if($_SESSION['recherche']=="cours"){
		$bouton_retour="/cours-de-danse/";
	}
	if($_SESSION['recherche']=="accueil"){
		$bouton_retour="//www.lepetitbal.com";
	}	
}
$mail = 'contact@lepetitbal.com'; // Déclaration de l'adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
{
    $passage_ligne = "\r\n";
}
else
{
    $passage_ligne = "\n";
}
// LIST DES INPUTS
$nom_lieu = htmlspecialchars($_POST['revendiquer_nom_lieu']);
$email_membre = htmlspecialchars($_POST['email_membre']);

//=====Déclaration des messages au format texte et au format HTML.
//$message_txt = "Description: ".$description_report;
$message_html = "<html><head></head><body><p><b>Nom du lieu revendiqué :</b></p><p>".$nom_lieu."</p><p><b>Expéditeur: </b></p><p>".$email_membre."</p></body></html>";

//=====Création de la boundary.
$boundary = "-----=".md5(rand());
$boundary_alt = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "Revendiquer Lieu Annonceur - ". $nom_lieu;
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"Annonceur Section\"<annonceur@mail.fr>".$passage_ligne;
$header.= "Reply-to: \"".$email_membre."\" <".$email_membre.">".$passage_ligne;
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
//==========
$_SESSION['success']= "Votre demande à bien été envoyée, vous aller recevoir sous 24h un mail de confirmation.";
header('Refresh: 0 ; url='.$bouton_retour);
?>

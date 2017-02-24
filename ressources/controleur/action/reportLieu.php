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
$lieu_report = htmlspecialchars($_POST['lieu_report']);
$nom_lieu_report = htmlspecialchars($_POST['nom_lieu_report']);
$type_report = htmlspecialchars($_POST['type_report']);
$description_report = htmlspecialchars($_POST['description_report']);
if(isset($_POST['adresse_mail_report'])){
    $adresse_mail_input = htmlspecialchars($_POST['adresse_mail_report']);
}
else{
    $adresse_mail_input="no-reply";
}

//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Description: ".$description_report;
$message_html = "<html><head></head><body><p><b>Description:</b></p><p>".$description_report."</p><p><b>Lieu/Organisation: </b></p><p>".$nom_lieu_report."</p><p><b>Expéditeur: </b></p><p>".$adresse_mail_input."</p></body></html>";

//=====Création de la boundary.
$boundary = "-----=".md5(rand());
$boundary_alt = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "Report lepetitbal - ".$lieu_report." - ".$type_report;
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"Report Section\"<report@mail.fr>".$passage_ligne;
$header.= "Reply-to: \"".$adresse_mail_input."\" <".$adresse_mail_input.">".$passage_ligne;
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
$_SESSION['success']= "Le lieu a bien été signalé, merci pour votre participation.";
header('Refresh: 0 ; url='.$bouton_retour);
?>

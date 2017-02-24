<?php
session_start();
if(isset($_SESSION['email_membre'])){
	$id_lieu = $_POST['id_lieu'];
	$email_membre=$_SESSION['email_membre'];
	require("connexion_sql.php");
	
	// REGARDE SI L'UTILISATEUR A DEJA VOTE POUR CE LIEU
	$checkVote = $bdd->prepare("SELECT * FROM `upvote_table` WHERE `id_lieu_upvote`=? AND `email_membre_upvote`=?"); // SELECT USER ID FROM DB TO SEE IF THEY HAVE VOTED ON THIS ITEM BEFORE
	$checkVote->execute(array($id_lieu,$email_membre));
	$count = $checkVote->rowCount(); // on rowCount() la requete, donc rowcount retournera une valeur si il trouve.
	$checkVote->closeCursor();
	if($count == 0) // s'il trouve une valeur alors on renvoi 1;
	{
		echo "0";
	} 
	else{ 
		echo "1"; 
	} 
}
?>
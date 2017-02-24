/* MENU NON CONNECTE */
$(document.body).on('click', '#menu_connexion' ,function(){
	$('#tab_connexion').removeClass("active");
	$('#tab_inscription').removeClass("active");
	$('#tab_mdp_oublie').removeClass("active");
	
	$('#home').removeClass("active"); //connexion
	$('#profile').removeClass("active"); //inscription
	$('#forget_password').removeClass("active");//forget psswd
	
	$('#tab_connexion').addClass("active");
	$('#home').addClass("active");
});

$(document.body).on('click', '#menu_inscription' ,function(){
	$('#tab_connexion').removeClass("active");
	$('#tab_inscription').removeClass("active");
	$('#tab_mdp_oublie').removeClass("active");
	
	$('#home').removeClass("active"); //connexion
	$('#profile').removeClass("active"); //inscription
	$('#forget_password').removeClass("active");//forget psswd	
	
	$('#tab_inscription').addClass("active");
	$('#profile').addClass("active"); //inscription
});

$("#faq_annonceur").change(function() {
	$('#modifier_evenement').removeClass("hidden");
	$('#poser').removeClass("hidden");
	if($(this).val()=="modifier_evenement"){
		$('#poser').addClass("hidden");
	}
	else{
		$('#modifier_evenement').addClass("hidden");	
	}
});

/* MENU MEMBRE */
$(document.body).on('click', '#menu_mon_compte' ,function(){
	$('#tab_mon_compte').removeClass("active");
	$('#tab_devenir_annonceur').removeClass("active");
	
	$('#mon_compte').removeClass("active");
	$('#devenir_annonceur').removeClass("active");
	
	$('#tab_mon_compte').addClass("active");
	$('#mon_compte').addClass("active");
});
$(document.body).on('click', '#menu_devenir_annonceur' ,function(){
	$('#tab_mon_compte').removeClass("active");
	$('#tab_devenir_annonceur').removeClass("active");
	
	$('#mon_compte').removeClass("active");
	$('#devenir_annonceur').removeClass("active");
	
	$('#tab_devenir_annonceur').addClass("active");
	$('#devenir_annonceur').addClass("active");
});

/* MENU ANNONCEUR */
$(document.body).on('click', '#menu_mon_compte_annonceur' ,function(){
	$('#tab_mon_compte').removeClass("active");
	$('#tab_achat_jeton').removeClass("active");
	$('#tab_ajout_event').removeClass("active");
	
	$('#mon_compte').removeClass("active");
	$('#achat_jeton').removeClass("active");
	$('#ajout_event').removeClass("active");
	
	$('#tab_mon_compte').addClass("active");
	$('#mon_compte').addClass("active");
});
$(document.body).on('click', '#menu_gerer_jeton_annonceur' ,function(){
	$('#tab_mon_compte').removeClass("active");
	$('#tab_achat_jeton').removeClass("active");
	$('#tab_ajout_event').removeClass("active");
	
	$('#mon_compte').removeClass("active");
	$('#achat_jeton').removeClass("active");
	$('#ajout_event').removeClass("active");
	
	$('#tab_achat_jeton').addClass("active");
	$('#achat_jeton').addClass("active");
});
$(document.body).on('click', '#menu_ajout_event_annonceur' ,function(){
	$('#tab_mon_compte').removeClass("active");
	$('#tab_achat_jeton').removeClass("active");
	$('#tab_ajout_event').removeClass("active");
	
	$('#mon_compte').removeClass("active");
	$('#achat_jeton').removeClass("active");
	$('#ajout_event').removeClass("active");
	
	$('#tab_ajout_event').addClass("active");
	$('#ajout_event').addClass("active");
});
/* MENU ADMIN */
$(document.body).on('click', '#menu_mon_compte_admin' ,function(){
	$('#tab_mon_compte').removeClass("active");
	$('#tab_achat_jeton').removeClass("active");
	$('#tab_ajout_event').removeClass("active");
	$('#tab_ajouter_lieu').removeClass("active");
	$('#tab_affection_proprio').removeClass("active");
	$('#tab_crediter_membre').removeClass("active");
	
	$('#mon_compte').removeClass("active");
	$('#achat_jeton').removeClass("active");
	$('#ajout_event').removeClass("active");
	$('#ajouter_lieu').removeClass("active");
	$('#affection_proprio').removeClass("active");
	$('#crediter_membre').removeClass("active");
	
	$('#tab_mon_compte').addClass("active");
	$('#mon_compte').addClass("active");
});
$(document.body).on('click', '#menu_gerer_jeton_admin' ,function(){
	$('#tab_mon_compte').removeClass("active");
	$('#tab_achat_jeton').removeClass("active");
	$('#tab_ajout_event').removeClass("active");
	$('#tab_ajouter_lieu').removeClass("active");
	$('#tab_affection_proprio').removeClass("active");
	$('#tab_crediter_membre').removeClass("active");
	
	$('#mon_compte').removeClass("active");
	$('#achat_jeton').removeClass("active");
	$('#ajout_event').removeClass("active");
	$('#ajouter_lieu').removeClass("active");
	$('#affection_proprio').removeClass("active");
	$('#crediter_membre').removeClass("active");
	
	$('#tab_achat_jeton').addClass("active");
	$('#achat_jeton').addClass("active");
});
$(document.body).on('click', '#menu_ajout_event_admin' ,function(){
	$('#tab_mon_compte').removeClass("active");
	$('#tab_achat_jeton').removeClass("active");
	$('#tab_ajout_event').removeClass("active");
	$('#tab_ajouter_lieu').removeClass("active");
	$('#tab_affection_proprio').removeClass("active");
	$('#tab_crediter_membre').removeClass("active");
	
	$('#mon_compte').removeClass("active");
	$('#achat_jeton').removeClass("active");
	$('#ajout_event').removeClass("active");
	$('#ajouter_lieu').removeClass("active");
	$('#affection_proprio').removeClass("active");
	$('#crediter_membre').removeClass("active");
	
	$('#tab_ajout_event').addClass("active");
	$('#ajout_event').addClass("active");	
});
$(document.body).on('click', '#menu_ajout_lieu_admin' ,function(){
	$('#tab_mon_compte').removeClass("active");
	$('#tab_achat_jeton').removeClass("active");
	$('#tab_ajout_event').removeClass("active");
	$('#tab_ajouter_lieu').removeClass("active");
	$('#tab_affection_proprio').removeClass("active");
	$('#tab_crediter_membre').removeClass("active");
	
	$('#mon_compte').removeClass("active");
	$('#achat_jeton').removeClass("active");
	$('#ajout_event').removeClass("active");
	$('#ajouter_lieu').removeClass("active");
	$('#affection_proprio').removeClass("active");
	$('#crediter_membre').removeClass("active");
	
	$('#tab_ajouter_lieu').addClass("active");
	$('#ajouter_lieu').addClass("active");	
});
$(document.body).on('click', '#menu_affection_proprio_admin' ,function(){
	$('#tab_mon_compte').removeClass("active");
	$('#tab_achat_jeton').removeClass("active");
	$('#tab_ajout_event').removeClass("active");
	$('#tab_ajouter_lieu').removeClass("active");
	$('#tab_affection_proprio').removeClass("active");
	$('#tab_crediter_membre').removeClass("active");
	
	$('#mon_compte').removeClass("active");
	$('#achat_jeton').removeClass("active");
	$('#ajout_event').removeClass("active");
	$('#ajouter_lieu').removeClass("active");
	$('#affection_proprio').removeClass("active");
	$('#crediter_membre').removeClass("active");
	
	$('#tab_affection_proprio').addClass("active");
	$('#affection_proprio').addClass("active");	
});
$(document.body).on('click', '#menu_credit_membre_admin' ,function(){
	$('#tab_mon_compte').removeClass("active");
	$('#tab_achat_jeton').removeClass("active");
	$('#tab_ajout_event').removeClass("active");
	$('#tab_ajouter_lieu').removeClass("active");
	$('#tab_affection_proprio').removeClass("active");
	$('#tab_crediter_membre').removeClass("active");
	
	$('#mon_compte').removeClass("active");
	$('#achat_jeton').removeClass("active");
	$('#ajout_event').removeClass("active");
	$('#ajouter_lieu').removeClass("active");
	$('#affection_proprio').removeClass("active");
	$('#crediter_membre').removeClass("active");
	
	$('#tab_crediter_membre').addClass("active");
	$('#crediter_membre').addClass("active");	
});



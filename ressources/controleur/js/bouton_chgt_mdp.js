$(document).ready(function() {
   $('body').on('click', '#btn_changer_mdp', function() {
	var plateforme = $("#chgt-mdp-plateforme").val();
	if(plateforme=="lepetitbal"){
		if($(this).parent().find("#zone-bouton-changer-mdp").hasClass("collapse") && !$(this).parent().find("#zone-bouton-changer-mdp").hasClass("in")){
		   $(this).parent().find("#zone-bouton-changer-mdp").collapse("show");
		}
		else{
		   $(this).parent().find("#zone-bouton-changer-mdp").collapse("hide");
		}
	}
	else{
		alertify.alert("Vous ne devez pas vous connecter avec Facebook ni Google pour changer votre mot de passe!");
	}
   });
});
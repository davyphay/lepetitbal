$(document).ready(function() {
	$('body').on('click', '.vote', function(event) {
		event.stopPropagation();
		if($('.email_membre_input').val()!=="") {
		var id = $(this).attr("id_lieu");
		console.log(id);
		var name = $(this).attr("name");
		console.log(name);
		var self = $(this); // cache $this
		var parent = self.parent(); // grab grand parent .item
		if (!parent.hasClass('disabled_upvote')) {
			if(name=='up'){
			$(this).fadeIn(200);
			$.ajax({
			   type: "POST",
			   url: "/ressources/modele/weblectureupvote.php",
			   data: {id_lieu:id},
			   cache: false,
			   success : function () {
					var test = parseInt($('.compteur_upvote_'+parseInt(id)).html()); // retrouve la valeur contenue dans le div compteur upvote et la transforme en int
					test = test+1;	 // incrémente cette valeur
					$('.compteur_upvote_'+id).text(test); //changement de la valeur
					},
			});
			}
		surligner_upvote(id);
		}
		else{
			if(name=='up'){
			$(this).fadeIn(200);
			$.ajax({
			   type: "POST",
			   url: "/ressources/modele/weblecturedownvote.php",
			   data: {id_lieu:id},
			   cache: false,
			   success : function () {
					var test = parseInt($('.compteur_upvote_'+parseInt(id)).html()); // retrouve la valeur contenue dans le div compteur upvote et la transforme en int
					test = test-1;	 // incrémente cette valeur
					$('.compteur_upvote_'+id).text(test); //changement de la valeur
					},
			});
			}
		desurligner_upvote(id);
		}
	}
	else{
		alertify.alert("Attention !","Vous devez vous connecter pour pouvoir recommander un lieu !");
	}
	});
});

// Affiche upvote button du lieu coché si utilisateur déjà upvote après avoir générer les billets
$(document).on('function_addMarkers_complete',function () {
	//Pour tous les billets , envoie une requete ajax
	$('.billet').each(function(){
		var id_lieu = "";
		id_lieu = parseInt($(this).attr('id_lieu'));
		$.ajax({
			type: "POST",
			url: "../ressources/modele/get_upvote_utilisateur.php",
			data: {
				id_lieu: id_lieu
			},
			success: function (data){
				if (data == "1"){ // l'utilisateur à déjà upvote
					surligner_upvote(id_lieu);
				}
			}
		});
	});
});

// function surligner upvote
function surligner_upvote(id_lieu){
	$('.upvote_'+id_lieu).addClass("disabled_upvote");
	$('.zonebouton_upvote_'+id_lieu).css('background-color', '#4AA44A');
}

// function désurligner upvote
function desurligner_upvote(id_lieu){
	$('.upvote_'+id_lieu).removeClass("disabled_upvote");
	$('.zonebouton_upvote_'+id_lieu).css('background-color', '#B6D086');
}
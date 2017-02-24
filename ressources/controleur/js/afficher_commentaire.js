// Affiche le nombre de commentaires sur le bouton après avoir générer les billets
$(document).on('function_addMarkers_complete',function () {
	//Pour tous les billets , envoie une requete ajax
        $('.billet').each(function(i){
                var id_lieu = "";
                var numero_billet=i+1;
                id_lieu = parseInt($(this).attr('id_lieu'));
                $.ajax({
                        type: "POST",
                        url: "../ressources/modele/get_nb_commentaire.php",
                        data: {
                                id_lieu: id_lieu
                        },
                        success: function (data){
                                if (data !== "erreur"){
                                        afficher_nb_commentaire(data,numero_billet);
                                }
                                else{
                                        alertify.alert("Le nombre de commentaires n'a pas pu être trouvé pour le billet "+numero_billet);
                                }
                        }
                });
        });

});

// Afficher les commentaires dans la zone prévue à cet effet lors du click sur le bouton commentaire
$(document).on('function_addMarkers_complete',function () {
	$(".bouton_commentaire").on('click',function () {
		var id_lieu = "";
		id_lieu = parseInt($(this).closest(".billet").attr('id_lieu'));
                $('#espaceCommentaireModal').find("#lieu_commentaire").val(id_lieu);
		var numero_billet="";
		numero_billet=parseInt($(this).closest(".billet").attr('numero_billet'));
		$('#espaceCommentaireModal').find("#numero_billet_commentaire").val(numero_billet);
		$.ajax({
			type: "POST",
			url: "../ressources/modele/get_commentaire.php",
			data: {
				id_lieu: id_lieu
			},
			success: function (data){
                                data = JSON.parse(data);
				if (data !== null && data!==undefined){
                                        var nb_commentaire = data.length;
                                        for(i=0;i<nb_commentaire;i++){
						var contenu_commentaire=data[i].contenu_commentaire;
						var pseudo_commentaire=data[i].pseudo_commentaire;
						var datetime_commentaire=data[i].date_convert;
                                                var adresse_email_commentaire=data[i].adresse_mail_commentaire;
                                                var id_commentaire=data[i].id_commentaire;
						afficher_commentaire(contenu_commentaire,pseudo_commentaire,datetime_commentaire,adresse_email_commentaire,id_commentaire,i);
					}
				}
				else{
					afficher_commentaire_default(id_lieu);
				}
			}
		});
	});
});

$(document).on('function_addMarkers_complete',function () {
	$('#espaceCommentaireModal').on('hidden.bs.modal', function () {
		$(".zone-commentaire-commentaire").empty();
		//Reset en mémoire de l'id du lieu et num billet
		$('#lieu_commentaire').val('');
		$('#numero_billet_commentaire').val('');
	});
});

//Reouvrir page commentaire du billet correspondant après avoir envoyé un com
$(document).on('function_addMarkers_complete',function () {
	numero_billet=$('#redirection_commentaire').val();
	if(numero_billet!==""){
		$('#billet'+numero_billet+'inner_right_panel').find(".bouton_commentaire").click();
                var nom_lieu="";
		nom_lieu=$('#billet'+numero_billet+'inner_right_panel').attr('nom');
                $('#espaceCommentaireModal').find("#name_commentaire").val(nom_lieu);
                $('#espaceCommentaireModal').find("#numero_billet_commentaire_modifier").val(numero_billet);
                $("#espaceCommentaireModal").modal('show');
                $('#redirection_commentaire').val("");
	}
});


function afficher_commentaire(contenu,pseudo,datetime,adresse_email,id_commentaire,numero_commentaire){
	// creation des billets commentaires
        var content='<div id="commentaire_commentaire_'+numero_commentaire+'" class="commentaire_commentaire"><div class="commentaire_left"><div class="commentaire_pseudo"><b>'+pseudo+'</b></div><div class="commentaire_contenu"><div>'+contenu+'</div><div id="commentaire_footer_'+numero_commentaire+'" class="commentaire_footer"><div class="commentaire_datetime"><i>'+datetime+'</i></div></div></div></div></div>';
        $('.zone-commentaire-commentaire').append(content);
        var adresse = $('.email_membre_input').val();
        if(adresse==adresse_email){
                content_connected='<i id="modifier_commentaire" value="'+id_commentaire+'" title="Modifier votre commentaire" class="fa fa-pencil-square-o commentaire_footer_button"></i><i id="supprimer_commentaire" value="'+id_commentaire+'" title="Supprimer votre commentaire" class="fa fa-times commentaire_footer_button"></i>';
                $('#commentaire_footer_'+numero_commentaire).prepend(content_connected);
        }
}
function afficher_commentaire_default(){
	//creation du billet commentaire a default de commentaire...
        var contenu_vide='<div class="absence_commentaire"><i></br>Il n\'y a pas encore de commentaire pour ce lieu. Soyez le premier!</i></div>';
        $('.zone-commentaire-commentaire').html(contenu_vide);
}

function afficher_nb_commentaire(data,numero_billet){
	var content = '<i class="fa fa-comments" aria-hidden="true"></i> '+data;
	$('#billet'+numero_billet+'inner_right_panel').find(".bouton_commentaire").html(content);
}

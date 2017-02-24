/* CGU */
$(document).ready(function() {
   $('body').on('click', '#espace_CGU', function() {
      if($("#espace_CGU_content").hasClass("collapse") && !$("#espace_CGU_content").hasClass("in")){
         $("#espace_CGU_content").collapse("show");
		 $(this).find("i").removeClass("fa-angle-down").addClass("fa-angle-up");
      }
      else{
        $("#espace_CGU_content").collapse("hide");
		$(this).find("i").removeClass("fa-angle-up").addClass("fa-angle-down");
      }
   });
});

$(document).ready(function() {
   $('body').on('click', '#espace_CGV', function() {
      if($("#espace_CGV_content").hasClass("collapse") && !$("#espace_CGV_content").hasClass("in")){
         $("#espace_CGV_content").collapse("show");
		 $(this).find("i").removeClass("fa-angle-down").addClass("fa-angle-up");
      }
      else{
        $("#espace_CGV_content").collapse("hide");
		$(this).find("i").removeClass("fa-angle-up").addClass("fa-angle-down");
      }
   });
});

/* CGV */
function confSubmit()
{
    if(!document.getElementById("one").checked)
    { 
		alertify.alert("Veuillez lire et accepter les conditions générales de vente.");
        return false;
    }
}

/* CHGT MDP */
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

/* COMMENTAIRE */
$(document).ready(function() {
	$('body').on('click', '.bouton_commentaire', function(event) {
		event.stopPropagation();
		
		var id_lieu="";
		id_lieu=parseInt($(this).closest(".billet").attr('id_lieu'));
        $('#espaceCommentaireModal').find("#lieu_commentaire").val(id_lieu);
		
		var numero_billet="";
		numero_billet=parseInt($(this).closest(".billet").attr('numero_billet'));
		$('#espaceCommentaireModal').find("#numero_billet_commentaire").val(numero_billet);
		$('#espaceCommentaireModal').find("#numero_billet_commentaire_modifier").val(numero_billet);
		
		var nom_lieu="";
		nom_lieu=$(this).closest(".billet").attr('nom');
		$('#espaceCommentaireModal').find("#name_commentaire").val(nom_lieu);
		
		$("#espaceCommentaireModal").modal('show');
	});
});

/* DELETE IMAGE */
$('input[type=file]').change(function(){
	$('.form-control-clear').toggleClass('hidden');
	var files = $(this)[0].files;
    if (files.length > 0) {
		// On part du principe qu'il n'y qu'un seul fichier
		// étant donné que l'on a pas renseigné l'attribut "multiple"
		var file = files[0],
		$image_preview = $('#image_preview');
		$image_preview.find('.thumbnail').removeClass('hidden');
		$image_preview.find('img').attr('src', window.URL.createObjectURL(file));
	}
});
$(document).ready(function(){
	$('#feedback').on('click',function(){
		// RAZ des données du filestyle
		$(":file").filestyle('clear');
		//RAZ image preview
		$('#image_preview').find('.thumbnail').addClass('hidden');
		//RAZ balise change detection
		$(this).closest('form').data('changed', true);
		//RAZ input image default
		$('#image_lieu_old').val("");
		//Suppression du bouton delete
		$('.form-control-clear').toggleClass('hidden');
	});
});

/* MODIFIER LIEU */
function bouton_modifier(id_lieu){
	var session = document.getElementById("sess_var").value;
	if(session=="yes"){
		window.location.href = '/modifier/?id_lieu='+id_lieu;		
	}
	else if (session=="no"){
		alertify.alert("Attention!","Vous devez vous connecter pour modifier le lieu");
	}
}

$(document).ready(function() {
	$('body').on('click', '.bouton_modifier_header', function(event) {
		event.stopPropagation();
		var id_lieu="";
		id_lieu=parseInt($(this).closest(".billet").attr('id_lieu'));
        $('#espaceReportModal').find("#lieu_commentaire").val(id_lieu);
		
		bouton_modifier(id_lieu);
	});
});

/* Obtenir Jeton*/
$(document).ready(function() {
	$('.bouton_obtenir_jeton').on('click',function(){
      $("#espaceMembreModal").find(".active").removeClass("active");
      $('#tab_achat_jeton').addClass("active");
      $('#achat_jeton').addClass("active");
		$("#espaceMembreModal").modal('show');
	});
});

$(document).ready(function() {
	$('#bouton_obtenir_jeton_espace_membre').on('click',function(){
		$('#achat_jeton-taba').click();
	});
});

/* Ajouter event*/
$(document).ready(function() {
	$('#bouton_ajout_event').on('click',function(){
      $("#espaceMembreModal").find(".active").removeClass("active");
      $('#tab_ajout_event').addClass("active");
      $('#ajout_event').addClass("active");
		$("#espaceMembreModal").modal('show');
	});
});

/* Report */
$(document).ready(function() {
	$('body').on('click', '.bouton_report_header', function(event) {
		event.stopPropagation();
		
		var id_lieu="";
		id_lieu=parseInt($(this).closest(".billet").attr('id_lieu'));
        $('#espaceReportModal').find("#lieu_report").val(id_lieu);
		
		var numero_billet="";
		numero_billet=parseInt($(this).closest(".billet").attr('numero_billet'));
		$('#espaceReportModal').find("#numero_billet_report").val(numero_billet);
		
		var nom_lieu="";
		nom_lieu=$(this).closest(".billet").attr('nom');
		$('#espaceReportModal').find("#name_report").val(nom_lieu);
		$('#espaceReportModal').find("#nom_lieu_report").val(nom_lieu);
		
		$("#espaceReportModal").modal('show');
	});
});

/* Bouton entrer*/
//Boutons espace formulaire annonceur
if(document.getElementById('name')){
    document.getElementById('name').onkeypress=function(e){
        if(e.keyCode==13){
            document.getElementById('btn').click();
        }
    };
}

if(document.getElementById('proprietaire')){
    document.getElementById('proprietaire').onkeypress=function(e){
        if(e.keyCode==13){
            document.getElementById('btn').click();
        }
    };
}

if(document.getElementById('adresse')){
    document.getElementById('adresse').onkeypress=function(e){
        if(e.keyCode==13){
            document.getElementById('btn').click();
        }
    };
}

if(document.getElementById('commentaire')){
    document.getElementById('commentaire').onkeypress=function(e){
        if(e.keyCode==13){
            document.getElementById('btn').click();
        }
    };
}

/* Old geocode */
//Verif si le membre est connecté avant d'envoyer le commentaire
$(function() {
    $('#btn_comment_lieu').click(function() {
        if($('.email_membre_input').val()){
            if($('#pseudo_commentaire').val()!==""){
                if($('#contenu_commentaire').val()!==""){
                    $('#form_commenter_lieu').trigger('submit');
                }
                else{
                    alertify.alert("Attention !",'Vous devez mettre un commentaire');
                    return false;  
                }
            }
            else{
                alertify.alert("Attention !",'Vous devez mettre un pseudo');
                return false;
            }
        }
        else{
            alertify.alert("Attention !",'Vous devez vous connecter pour envoyer des commmentaires');
            return false;
        }
    });
});

$(function() {
    $('#btn_crediter_membre').click(function() {
        if($('#email_credit').val()){
            if($('#nb_jeton_credit').val()>0){
                $('#form_crediter_membre').trigger('submit');
            }
            else{
                alertify.alert("Attention !",'Vous devez saisir un nombre de jeton positif');
                return false;   
            }
        }
        else{
            alertify.alert("Attention !",'Vous devez saisir une adresse mail');
            return false;
        }    
    });
});

$(function() {
    $('#btn_affecter_proprio').click(function() {
        if($('#affection_email_proprio').val()){
            if($('#affection_proprio_lieu').val()){
                $('#form_affection_proprietaire').trigger('submit');
            }
            else{
                alertify.alert("Attention !",'Vous devez saisir un nom de lieu');
                return false;   
            }
        }
        else{
            alertify.alert("Attention !",'Vous devez saisir une adresse mail');
            return false;
        }    
    });
});

$(function() {
    $('#btn_revendiquer_lieu').click(function() {
        if($('#revendiquer_nom_lieu').val()){
            alertify.confirm('Confirmation de revendication du lieu',
                'Voulez-vous vraiment revendiquer le lieu "'+$('#revendiquer_nom_lieu').val()+'" ?</br> Un email sera envoyé à nos services pour vérification.</br> Vous obtiendrez un mail de confirmation lorsque l\'opération sera terminé.',
                function(){$('#form_revendiquer_lieu').trigger('submit');},
                function(){alertify.error('Opération annulée');}
            );
        }
        else{
            alertify.alert("Attention !",'Vous devez saisir un nom de lieu');
            return false;
        }    
    });
});

$(function() {
    $('#btn_devenir_annonceur').click(function() {
        //CHECK SI UNE COMMUNAUTE EST SELECTIONNEE
        if($('#nom_lieu').val() !==''){
            if ($('input[name=communaute_lieu_salsa]').is(':checked') || $('input[name=communaute_lieu_bachata]').is(':checked') || $('input[name=communaute_lieu_kizomba]').is(':checked') || $('input[name=communaute_lieu_rock4T]').is(':checked') || $('input[name=communaute_lieu_rock6T]').is(':checked') || $('input[name=communaute_lieu_swing]').is(':checked') || $('input[name=communaute_lieu_wcs]').is(':checked') || $('input[name=communaute_lieu_tango]').is(':checked') || $('input[name=communaute_lieu_salon]').is(':checked')){
                if ($('input[name=activite_cours]').is(':checked') || $('input[name=activite_soiree]').is(':checked') || $('input[name=activite_event]').is(':checked')){
                    $('#form_ajout_lieu_demande').trigger('submit');
                }
                else{
                    alertify.alert("Attention !",'Au moins une activité doit être sélectionnée.');
                    return false;
                }
            }
            else{
                alertify.alert("Attention !",'Au moins une communauté doit être sélectionnée.');
                return false;
            }
        }
        else{
            alertify.alert("Attention !",'Vous devez saisir un nom de lieu');
            return false; 
        }
    });
});

//BTN actions
$(function() {
    $('#btn_promouvoir_lieu').click(function() {
        nb_jetons_max = $('#nb_jetons_utilise').attr("max");
        if(nb_jetons_max>0){
            nb_jeton_utilise= $('#nb_jetons_utilise').val();
            if(nb_jeton_utilise>0){
                date_fin_promotion = $('#date_picker').val();
                r="";
                alertify.confirm('Confirmation de promotion',
                        'Voulez-vous utiliser '+nb_jeton_utilise+' jeton(s) pour promouvoir ce lieu jusqu\'au '+date_fin_promotion+' ?',
                        function(){$('#form_promouvoir_lieu').submit();},
                        function(){alertify.error('Opération annulée');}
                );
            }
            else{
                alertify.alert("Attention !","Vous devez au moins utiliser un jeton.");
            }
        }
        else{
            alertify.alert("Attention !","Vous n'avez pas assez de jetons. Vous pouvez en obtenir dans l'espace membre.");
        } 
    });
});

//BTN redirections lieux
$(function() {
    $('#btn_redirection_promotion_lieu').click(function() {
            $('#promotion_lieu-taba').trigger('click');
    });
});
$(function() {
    $('#btn_redirection_fiche_lieu').click(function() {
            $('#modifier_lieu-taba').trigger('click');
    });
});

$(function(){
    $('#btn_modifier_evenement').click(function() {
        // check si les inputs sont remplis
        if($('#date_evenement').val() !==''){
            if($('#heure_debut_evenement').val() !==''){
                if($('#heure_fin_evenement').val() !==''){
                    if($('#titre_evenement').val() !==''){
                        if($('#danse_pratique_evenement').val() !==''){
                            if($('#tarifs_evenement').val() !==''){
                                if($('input[name=communaute_evenement_salsa]').is(':checked') || $('input[name=communaute_evenement_bachata]').is(':checked') || $('input[name=communaute_evenement_kizomba]').is(':checked') || $('input[name=communaute_evenement_rock4T]').is(':checked') || $('input[name=communaute_evenement_rock6T]').is(':checked') || $('input[name=communaute_evenement_swing]').is(':checked') || $('input[name=communaute_evenement_wcs]').is(':checked') || $('input[name=communaute_evenement_tango]').is(':checked') || $('input[name=communaute_evenement_salon]').is(':checked')){
                                    $('#form_modifier_evenement').trigger('submit');
                                }
                                else{
                                    alertify.alert("Attention !",'Vous devez indiquer au moins un type de danse!');
                                    return false;
                                }
                            }
                            else{
                                alertify.alert("Attention !","Vous devez saisir les tarifs de l'évènement!");
                                return false;    
                            }
                        }
                        else{
                            alertify.alert("Attention !",'Vous devez saisir les danses pratiquées!');
                            return false;  
                        }
                    }
                    else{
                        alertify.alert("Attention !",'Vous devez saisir un titre d\'évènement!');
                        return false;
                    }
                }
                else{
                    alertify.alert("Attention !",'Vous devez saisir une horaire de fin!');
                    return false; 
                }
            }
            else{
                alertify.alert("Attention !",'Vous devez saisir une horaire de début!');
                return false; 
            }
        }
        else{
            alertify.alert("Attention !",'Vous devez saisir une date!');
            return false;  
        }
    });
});

// Toggle Check box: affiche/cache le planning
$(function(){
   $('#activite_lieu_cours').click(function() {
         if($(this).is(':checked')){
            $("#bouton-planning-cours").removeClass("hidden");  // checked
         }
         else{
            $("#bouton-planning-cours").addClass("hidden");  // unchecked
         }
   });
});
$(function(){
   $('#activite_lieu_soiree').click(function() {
         if($(this).is(':checked')){
            $("#bouton-planning-soiree").removeClass("hidden");  // checked
         }
         else{
            $("#bouton-planning-soiree").addClass("hidden");  // unchecked
         }
   });
});
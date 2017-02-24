// Affiche extrait tous les events d'un lieu
$(document).on('function_addMarkers_complete',function () {
	//Pour tous les billets , envoie une requete ajax
        $('.billet').each(function(i){
                var id_lieu_evenement = "";
                var numero_billet=i+1;
                id_lieu_evenement = parseInt($(this).attr('id_lieu'));
                $.ajax({
                        type: "POST",
                        url: "../ressources/modele/get_affichage_extractEvenementLieu.php",
                        data: {
                                id_lieu_evenement: id_lieu_evenement
                        },
                        dataType : "json",
                        success: function (data){
                                if (data !== "erreur"){
                                        data_parsed = JSON.parse(data);
                                        if(data_parsed !== null){
                                                afficher_evenement(data,numero_billet);
                                        }
                                }
                                else{
                                        alertify.alert("Les évènements n'ont pas pu être trouvés pour le billet "+numero_billet);
                                }
                        }
                });
        });
});

function afficher_evenement(contenu,numero_billet){
	obj = JSON.parse(contenu);
	if(obj.length>0){
		//Transfo du content en html
		content_html = '<div class="encaps_recherche"><div class="caret-switch" data-toggle="collapse" href="#zone_event_recherche'+numero_billet+'"><div class="zone_icone_dropdown"><i class="fa fa-2x fa-caret-up"></i></div><div class="title_evenement_recherche">Evènements prévus les 30 prochains jours</div></div><div id="zone_event_recherche'+numero_billet+'" class="zone_event_recherche collapse in"></div></div>';
		$("#billet_event_list"+numero_billet+"inner_right_panel").html(content_html);
		
		for (var i = 0; i < obj.length; i++) {
			content_billet_event='<div id="event_recherche_'+numero_billet+'_'+i+'" class="event_recherche"> <div class="event_header_recherche"> <div id="event_header_left_recherche_'+numero_billet+'_'+i+'" class="event_header_left_recherche"> <div id="event_header_left_date_recherche_'+numero_billet+'_'+i+'" class="event_header_left_date_recherche"></div><div id="event_header_left_title_recherche_'+numero_billet+'_'+i+'" class="event_header_left_title_recherche txt-hover"></div></div><div class="event_header_right_recherche"> <div class="event_header_right_sticker_recherche"> <div id="event_header_right_sticker_initiation_recherche_'+numero_billet+'_'+i+'" class="event_header_right_sticker_initiation_recherche"></div><div id="event_header_right_sticker_special_recherche_'+numero_billet+'_'+i+'" class="event_header_right_sticker_special_recherche"></div></div><div class="event_header_right_horaire_recherche"> <div id="event_header_right_horaire_debut_recherche_'+numero_billet+'_'+i+'" class="event_header_right_horaire_debut_recherche"></div><div class="event_header_right_separator_recherche">-</div><div id="event_header_right_horaire_fin_recherche_'+numero_billet+'_'+i+'" class="event_header_right_horaire_fin_recherche"></div></div></div></div><div id="event_content_recherche_box" class="event_content_recherche_box collapse"> <div id="event_content_footer_recherche_'+numero_billet+'_'+i+'" class="event_content_footer_recherche"></div><div class="event_content_description_recherche"><div id="event_content_description_content_recherche_'+numero_billet+'_'+i+'" class="event_content_description_content_recherche"></div></div></div></div>';
			$("#zone_event_recherche"+numero_billet).append(content_billet_event);
			//Mise en place des infos
			//date transform
			var date_evenement = obj[i].date_evenement;
			var monthNames = [
				"janv.", "févr.", "mars",
				"avr.", "mai", "juin", "juill.",
				"août", "sept.", "oct.",
				"nov.", "déc."
			];
			var dayNames = [
				"Dimanche","Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"
			];
		
			var date = new Date(date_evenement);
			var dayIndex = date.getDay();
			var day = date.getDate();
			var monthIndex = date.getMonth();
			date_evenement = dayNames[dayIndex]+" "+ day +" "+ monthNames[monthIndex];
			
			var titre_evenement =obj[i].titre_evenement;
                        var organisateur_evenement =obj[i].organisateur_evenement;
			var heure_debut_evenement =obj[i].heure_debut_evenement;
			var heure_fin_evenement =obj[i].heure_fin_evenement;
                        var danse_pratique_evenement =obj[i].danse_pratique_evenement;
                        var tarifs_evenement =obj[i].tarifs_evenement;
			var url_fb_evenement =obj[i].url_fb_evenement;                        
			var description_evenement =obj[i].description_evenement;
			var initiation_evenement =obj[i].initiation_evenement;
			var special_evenement =obj[i].special_evenement;
			$("#event_header_left_date_recherche_"+numero_billet+"_"+i).html(date_evenement);
			$("#event_header_left_title_recherche_"+numero_billet+"_"+i).html(titre_evenement);
			$("#event_header_right_horaire_debut_recherche_"+numero_billet+"_"+i).html(heure_debut_evenement);
			$("#event_header_right_horaire_fin_recherche_"+numero_billet+"_"+i).html(heure_fin_evenement);
                        $("#event_content_footer_recherche_"+numero_billet+"_"+i).append("<div class='event_content_footer_info_recherche'><b> Danses pratiquées :</b> "+danse_pratique_evenement+"</div>");
                        $("#event_content_footer_recherche_"+numero_billet+"_"+i).append("<div class='event_content_footer_info_recherche'><b> Tarifs :</b> "+tarifs_evenement+"</div>");
                        
                        if(organisateur_evenement!==""){
                                orga_text='<div id="event_header_organisateur_'+numero_billet+'_'+i+'_recherche" class="event_header_organisateur_recherche">- '+organisateur_evenement+'</div>';
                                $('#event_header_left_recherche_'+numero_billet+'_'+i).append(orga_text);
                        }
			if(initiation_evenement==1){
				$("#event_header_right_sticker_initiation_recherche_"+numero_billet+"_"+i).html('<img src="../ressources/images/website/icon-human-shoes-footprints.png" style="width:16px;height:16px;" title="Avec initiation">');
			}
			if(special_evenement==1){
				$("#event_header_right_sticker_special_recherche_"+numero_billet+"_"+i).html('<i class="glyphicon glyphicon-star-empty" title="Evènement spécial"></i>');
			}
			if(description_evenement || url_fb_evenement){
				if(description_evenement){
                                        var lines = description_evenement.split("\\r\\n");
                                        for(var j=0,l=lines.length;j<l;j++){
                                                lines[j] = JSON.parse('"' + lines[j].replace(/\"/g, '\\"') + '"');//decodeURIComponent()
                                                var retour_ligne ="</br>";
                                                $("#event_content_description_content_recherche_"+numero_billet+"_"+i).append(lines[j]);
                                                $("#event_content_description_content_recherche_"+numero_billet+"_"+i).append(retour_ligne);
                                        }
				}
				if(url_fb_evenement){
					$("#event_content_footer_recherche_"+numero_billet+"_"+i).append('<a class="event_content_footer_lien_recherche" href="http://'+url_fb_evenement+'" target="_blank" title="Page facebook de l\'évènement">Lien facebook</a>');
				}
			}
			else{
				$("#event_content_description_recherche_"+numero_billet+"_"+i).html("<i>Description non renseignée</i>");
			}	
		}
	}
}
$(document.body).on('click', '.event_recherche' ,function(){
	if($(this).find(".event_content_recherche_box").hasClass("collapse") && $(this).find(".event_content_recherche_box").hasClass("in")){
	   $(this).find(".event_content_recherche_box").collapse("hide");
	}
	else{
	  $(this).find(".event_content_recherche_box").collapse("show");
	}
});

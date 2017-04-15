var infoWindows=[];
function genererBillets(extract,recherche){
	// FONCTION DE GENERATION DES INFOBULLES
	infowindow= new google.maps.InfoWindow({
		content:''
	});
	function addInfoWindowToMarker(map,marker,content_bulle){
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.close();
			var $anchor="";
			
			//si le billet est déjà ouvert, ne le ferme pas
			this.billet.find('.billet_content').click(function(){
				$('.billet_content').not(this).each(function(){
					$(this).collapse("hide");
				});
			});
			this.billet.find('.billet_content').click();

			if(this.billet.hasClass('passive-billet')){
				// met tous les billets en passif
				$('.active-billet').each(function(){			
					$(this).removeClass('active-billet');
					$(this).addClass('passive-billet');
				});
				infowindow.setContent('<div class="noscrollbar">'+content_bulle+'</div>');
				infowindow.open(map,marker);
				this.billet.removeClass('passive-billet');
				this.billet.addClass('active-billet');
				this.billet.find('.billet_content').collapse("show");
				var that = this;
				var $offset_calendrier=-25;
				var $offset_standard=-5;
				if(recherche=="calendrier"){
					var $window = $(window);
					if ($window.width() > 1012) {
						setTimeout((function() {
							//Scroll jusqu'à la date dans le calendrier
							$anchor = (that.billet.parent().position().top + $('#right_panel_resultat').scrollTop());
							$('#right_panel_resultat').animate({ scrollTop: $anchor+$offset_calendrier},'100','swing');
						}), 350);
					}
					else{
						setTimeout((function() {
							//Scroll jusqu'à la date dans le calendrier
							$anchor = (that.billet.position().top + $('#right_panel_resultat').scrollTop());
							$('#right_panel_resultat').animate({ scrollTop: $anchor+$offset_calendrier},'100','swing');
						}), 350);
					}
				}
				else if(recherche=="standard"){
					setTimeout((function() {
					//Scroll jusqu'en haut du billet
						$anchor = (that.billet.position().top + $('#right_panel_resultat').scrollTop());
						$('#right_panel_resultat').animate({ scrollTop: $anchor+$offset_standard},'100','swing');
					}), 350);
				}
			}
			else{
				//ferme ce billet si ouvert
				this.billet.find('.billet_content').collapse("hide");
				// met les billets en passif
				$('.active-billet').each(function(){			
					$(this).removeClass('active-billet');
					$(this).addClass('passive-billet');
				});
			}
		});
	}
	// Ajout event sur la map
	google.maps.event.addListener(map, 'click', function() {
		var body = $("#right_panel_resultat");
		body.stop().animate({scrollTop:0}, '100', 'swing');
		//ferme toutes les infoswindows dans gmaps
		infowindow.close();
		//ferme tous les billets et les mets en passif
		$('.active-billet').each(function(){			
			$(this).removeClass('active-billet');
			$(this).addClass('passive-billet');
		});
		$('#box9').attr("value","show");
		$('#box9').click();
		$('#hideall').removeClass('fa-compress');
		$('#hideall').removeClass('fa-expand');
		$('#hideall').addClass('fa-expand');
	});

	// FONCTION DE MISE EN PAGE DES BULLES INFOS
	function transform_info_marker(nom,adresse){
		var result="";
		result = "<b>"+nom+"</b>"+"</br>"+adresse+"</br>";
		return result;
	}
	
	//Function afficahge date
	function afficher_billet_date(date_evenement,compteur_jour){
		var monthNames = ["janv.","févr.","mars","avr.","mai","juin","juill.","août","sept.","oct.","nov.","déc."];
		var dayNames = ["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"];
		var dayIndex = date_evenement.getDay();
		var day = date_evenement.getDate();
		var monthIndex = date_evenement.getMonth();
		date_billet_jour = dayNames[dayIndex]+" "+ day +" "+ monthNames[monthIndex];
		var billet_jour = '<div id="jour'+compteur_jour+'" class="billet_jour"><div class="line_separator"></div><div class="billet_jour_text">'+date_billet_jour+'</div><div class="line_separator"></div></div>';
		$("#inner_right_panel").append(billet_jour);
		var espace_jour_content = '<div id="espace_jour'+compteur_jour+'" class="espace_jour"></div>';
		$("#inner_right_panel").append(espace_jour_content);
	}
	
	var markerList=[];
	var i=0,li=extract.length;
	var compteur_billet = 0;
	var compteur_marker = 0;
	var compteur_jour = 0;
	var billet;
	if(recherche=="standard"){
		 while(i<li){
			//Extractions des données du tableau extractJs et génération des billets/cours/event en fonction des cas
			var nom = extract[i].nom_lieu;
			var adresse = extract[i].adresse_lieu;
			var infoMarker = transform_info_marker(nom,adresse);
			var lat = extract[i].latitude_lieu;
			var lng = extract[i].longitude_lieu;
			var cours_hebdomadaire = extract[i].id_cours_hebdomadaire;
			var soiree_hebdomadaire = extract[i].id_soiree_hebdomadaire;
			 if(i===0){
				compteur_billet++;	
				//Génération du premier marqueur
				markerList[compteur_marker] = new google.maps.Marker({
					map: map,
					position: new google.maps.LatLng(lat,lng),
					label: String(compteur_billet),
				});
				
				// Génération du premier billet
				billet=presenterBillet(extract[i],compteur_billet);

				// Génération de l'infosbulle lié au premier marqueur
				markerList[compteur_marker].billet=billet;
				addInfoWindowToMarker(map, markerList[compteur_marker], infoMarker);
				
				// Génération du premier event s'il y en a un
				if(cours_hebdomadaire){
					presenterEvent_hebdomadaire(extract[i],compteur_billet,"cours");
				}
				if(soiree_hebdomadaire){
					presenterEvent_hebdomadaire(extract[i],compteur_billet,"soiree");
				}
			 }
			 // Génération d'un autre marqueur/billet si différent id du précédent
			else if(extract[i].id_lieu!==extract[i-1].id_lieu){
				compteur_billet++; // incrémentation du compteur billet
				compteur_marker++;
				compteur_event=0; // mise à zéro du compteur event
				
				markerList[compteur_marker] = new google.maps.Marker({
					map: map,
					position: new google.maps.LatLng(lat,lng),
					label: String(compteur_billet),
				});
				billet = presenterBillet(extract[i],compteur_billet);
				
				markerList[compteur_marker].billet=billet;
				addInfoWindowToMarker(map, markerList[compteur_marker], infoMarker);
				
				 if(cours_hebdomadaire){
					 presenterEvent_hebdomadaire(extract[i],compteur_billet,"cours");
				 }
				 if(soiree_hebdomadaire){
					 presenterEvent_hebdomadaire(extract[i],compteur_billet,"soiree");
				 }
			}
			i++;
		}
		return markerList;
	}
	else if(recherche=="calendrier"){
		//Place la date début du compteur ) J-1 de l'UTC
		var date=new Date();
		var offset = date.getTimezoneOffset();
		date.setDate(date.getDate()-1);
		date.setHours(0,offset*-1,0,0);
		while(i<li){
			//Extractions des données du tableau extractJs et génération des billets/cours/event en fonction des cas
			var nom_event = extract[i].nom_lieu;
			var adresse_event = extract[i].adresse_lieu;
			var infoMarker_event = transform_info_marker(nom_event,adresse_event);
			var lat_event = extract[i].latitude_lieu;
			var lng_event = extract[i].longitude_lieu;
			var id_lieu_event = extract[i].id_lieu;
			var j=0;
			var detecteur=0;
			if(i===0){
				//Incrémentation du compteur jour jusqu'à ce que l'on trouve un evenement
				date_evenement=new Date(extract[i].date_evenement);	
				while(date.getTime()<=date_evenement.getTime() && compteur_jour<30){
					date.setDate(date.getDate()+1);
					compteur_jour++;
				}
				//Génération billet date
				afficher_billet_date(date_evenement,compteur_jour);
				compteur_billet++;
				//Génération du premier marqueur
				markerList[compteur_marker] = new google.maps.Marker({
					map: map,
					position: new google.maps.LatLng(lat_event,lng_event),
					label: String(compteur_marker+1),
					id_lieu : id_lieu_event
				});
				// Génération du premier billet
				billet=presenterBillet_event(extract[i],compteur_billet,compteur_marker,compteur_jour); //return $('#billet'+compteur_billet+destination);
				// Génération de l'infosbulle lié au premier marqueur
				markerList[compteur_marker].billet=billet;
				addInfoWindowToMarker(map, markerList[compteur_marker],infoMarker_event);
			}
			else{
				if(extract[i].date_evenement==extract[i-1].date_evenement){ //si meme jour
					//Creer un autre billet le même jour
					compteur_billet++;
					//Test pour voir si le lieu est déjà tag et mémorisation du label tag
					while(j<markerList.length){
						if(extract[i].id_lieu==markerList[j].id_lieu){
							detecteur=1;
							compteur_marker_old = markerList[j].label;
						}
						j++;
					}
					//Générer un nouveau marqueur si lieu non déjà inscrit
					if(detecteur===0){
						compteur_marker++;
						markerList[compteur_marker] = new google.maps.Marker({
							map: map,
							position: new google.maps.LatLng(lat_event,lng_event),
							label: String(compteur_marker+1),
							id_lieu : id_lieu_event
						});
						//Générer le billet
						billet=presenterBillet_event(extract[i],compteur_billet,compteur_marker,compteur_jour);
						//Générer infobulle
						markerList[compteur_marker].billet=billet;
						addInfoWindowToMarker(map, markerList[compteur_marker],infoMarker_event);
					}
					else{
						compteur_marker++;
						markerList[compteur_marker] = new google.maps.Marker({
							map: map,
							position: new google.maps.LatLng(lat_event,lng_event),
							label: String(compteur_marker_old),
							id_lieu : id_lieu_event
						});
						//Générer le billet seul
						billet=presenterBillet_event(extract[i],compteur_billet,compteur_marker_old-1,compteur_jour);
						//Générer infobulle
						markerList[compteur_marker].billet=billet;
						addInfoWindowToMarker(map, markerList[compteur_marker],infoMarker_event);
					}
				}
				else{ //si autre jour
					
					//Incrémentation du compteur jour jusqu'à ce que l'on trouve un evenement
					date_evenement=new Date(extract[i].date_evenement);
					while(date.getTime()<=date_evenement.getTime() && compteur_jour<30){
						date.setDate(date.getDate()+1);
						compteur_jour++;
					}
					//Génération billet date
					afficher_billet_date(date_evenement,compteur_jour);
					//Creer un nouveau billet un nouveau jour
					compteur_billet++;
					//Test pour voir si le lieu est déjà tag et mémorisation du label tag
					while(j<markerList.length){
						if(extract[i].id_lieu==markerList[j].id_lieu){
							detecteur=1;
							compteur_marker_old = markerList[j].label;
						}
						j++;
					}
					//Générer un nouveau marqueur si lieu non déjà inscrit sinon réutiliser le numéro
					if(detecteur===0){
						compteur_marker++;
						markerList[compteur_marker] = new google.maps.Marker({
							map: map,
							position: new google.maps.LatLng(lat_event,lng_event),
							label: String(compteur_marker+1),
							id_lieu : id_lieu_event
						});
						//Générer le billet
						billet=presenterBillet_event(extract[i],compteur_billet,compteur_marker,compteur_jour);
						//Générer infobulle
						markerList[compteur_marker].billet=billet;
						addInfoWindowToMarker(map, markerList[compteur_marker],infoMarker_event);
					}
					else{
						compteur_marker++;
						markerList[compteur_marker] = new google.maps.Marker({
							map: map,
							position: new google.maps.LatLng(lat_event,lng_event),
							label: String(compteur_marker_old),
							id_lieu : id_lieu_event
						});
						//Générer le billet seul
						billet=presenterBillet_event(extract[i],compteur_billet,compteur_marker_old-1,compteur_jour);
						//Générer infobulle
						markerList[compteur_marker].billet=billet;
						addInfoWindowToMarker(map, markerList[compteur_marker],infoMarker_event);
					}
				}
			}
			i++;
		}
		return markerList;
	}
}

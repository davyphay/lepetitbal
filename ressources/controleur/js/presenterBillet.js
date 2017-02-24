// Fonction de présentation du billet
function presenterBillet(tableauInfo,compteur_billet){
        //Stockage des info du tableau dans des variables
        var destination = "inner_right_panel";
        var num_billet = compteur_billet;
        var id_lieu = tableauInfo.id_lieu;
        var nom = tableauInfo.nom_lieu;
        var adresse = tableauInfo.adresse_lieu;
        var type_lieu = tableauInfo.type_lieu;
        var activiteCours = getActiviteCours(tableauInfo.activite_lieu); // ="Cours" si ok, sinon ="" tableauInfo[7]= activite_lieu
        var activiteSoiree = getActiviteSoiree(tableauInfo.activite_lieu); 
        var description = tableauInfo.description_lieu;
        var URL_web = tableauInfo.URL_web_lieu; 
        var URL_photo = tableauInfo.URL_photo_lieu;

        // Pour comparer les dates
        var date_expiration_promotion = new Date(tableauInfo.date_expiration_promotion_lieu);
        var today = new Date();
        today.setHours(0,0,0,0);
        date_expiration_promotion.setHours(0,0,0,0);
        var distance = tableauInfo.distance;
        var compteur_upvote=tableauInfo.upvote_lieu;
        
        //Creation des balises de texte
        var contenuNom=nom;
        var contenuURL_web=URL_web;
        var contenuDistance=distance+" km";
        var contenuCompteur_upvote=compteur_upvote;

        var nodeNom = document.createTextNode(contenuNom);
        var nodeURL_web = document.createTextNode("Lien vers le site internet");
        var nodeDistance = document.createTextNode(contenuDistance);
        var nodeCompteur_upvote=document.createTextNode(contenuCompteur_upvote);
        

        var paraNom = document.createElement("div");paraNom.id="nom";
        var paraAdresse = document.createElement("div");paraAdresse.id="adresse";
        var paraZoneDescription = document.createElement("div");paraZoneDescription.id="commentZone";
        var paraURL_photo = document.createElement("div");paraURL_photo.id="URL_photo";
        var paraDistance = document.createElement("div");paraDistance.id="distance";
        var paraUpvote = document.createElement("div");//paraUpvote.id="upvote_"+id_lieu;
        var paraComment = document.createElement("div");paraComment.id="commentaire";
        var paraZoneBouton_upvote = document.createElement("div");//paraZoneBouton_upvote.id="zonebouton_upvote_"+id_lieu;
        paraZoneBouton_upvote.setAttribute("name","up");paraZoneBouton_upvote.setAttribute("id_lieu",id_lieu);
        var paraBouton_upvote = document.createElement("div");//paraBouton_upvote.id="bouton_upvote_"+id_lieu;
        var paraCompteur_upvote = document.createElement("div");//paraCompteur_upvote.id="compteur_upvote_"+id_lieu;
        var paraReport = document.createElement("div");paraReport.id="report_"+id_lieu;
        var paraBouton_Report = document.createElement("div");paraBouton_Report.id="bouton_report_"+id_lieu;
        var paraModifier = document.createElement("div");paraReport.id="modifier_"+id_lieu;
        var paraBouton_modifier = document.createElement("div");paraBouton_modifier.id="bouton_modifier_"+id_lieu;
        
        paraNom.className="nom_header";
        paraDistance.className="distance_header";
        paraUpvote.className="upvote_"+id_lieu+" upvote_header";
        paraComment.className="comment_header";
        paraZoneBouton_upvote.className="zonebouton_upvote_"+id_lieu+" zone_bouton_upvote vote";
        paraBouton_upvote.className="bouton_upvote_"+id_lieu+" bouton_upvote_header";
        paraCompteur_upvote.className="compteur_upvote_"+id_lieu+" compteur_upvote_header";
        paraReport.className="report_header";
        paraModifier.className="modifier_header";
        paraBouton_Report.className="bouton_report_header";
        paraBouton_modifier.className="bouton_modifier_header";
        paraZoneDescription.className="commentZone_description";
        paraURL_photo.className="URL_photo_description thumbnail";
        paraAdresse.className="adresse_footer";
        
        paraNom.appendChild(nodeNom);
        paraAdresse.innerHTML="<b>"+type_lieu+"</b>, "+adresse;
        paraDistance.appendChild(nodeDistance);
        paraCompteur_upvote.appendChild(nodeCompteur_upvote);
        
        //création icone numérotée
        var iconNum_billet = document.createElement("img");
        iconNum_billet.src="../ressources/images/icons/marker_red"+num_billet+".png";
        iconNum_billet.height="27";
        iconNum_billet.width="16";
        var paraNum_billet = document.createElement("div");
        paraNum_billet.id="num_marker_"+num_billet;
        paraNum_billet.className='num_marker_header';
        paraNum_billet.appendChild(iconNum_billet);
        
        //Creation zone activité
        var paraActivite = document.createElement("div");
        paraActivite.id="activite_header_"+compteur_billet;
        paraActivite.className="activite_header";
        
        if(activiteCours!==""){
                paraZoneActivite_cours=document.createElement("div");
                paraZoneActivite_cours.className="zoneActivite_cours";
                paraZoneActivite_cours.title="Cours";
                paraZoneActivite_cours.innerHTML='<i class="fa fa-graduation-cap" aria-hidden="true"></i>';
                paraActivite.appendChild(paraZoneActivite_cours);                
        }

        if(activiteSoiree!==""){
                paraZoneActivite_soiree=document.createElement("div");
                paraZoneActivite_soiree.className="zoneActivite_soiree";
                paraZoneActivite_soiree.title="Soirées";
                paraZoneActivite_soiree.innerHTML='<i class="fa fa-glass" aria-hidden="true"></i>';
                paraActivite.appendChild(paraZoneActivite_soiree);                
        }
        //Creation bouton commentaire
        var billet_commentaire_bouton = document.createElement("div");
        billet_commentaire_bouton.className="bouton_commentaire";
        billet_commentaire_bouton.title="Voir les commentaires";

        var billet_commentaire_icon = document.createElement("i");
        billet_commentaire_icon.className="fa fa-comments";
        billet_commentaire_icon.setAttribute=("aria-hidden","true");
        billet_commentaire_bouton.appendChild(billet_commentaire_icon);
        paraComment.appendChild(billet_commentaire_bouton);
        
        //Creation bouton upvote
        var icon_Upvote = document.createElement("i");
        icon_Upvote.className="fa fa-thumbs-up";
        paraZoneBouton_upvote.title="Recommander";                            
        paraUpvote.appendChild(paraZoneBouton_upvote);
        paraZoneBouton_upvote.appendChild(paraBouton_upvote);
        paraZoneBouton_upvote.appendChild(paraCompteur_upvote);
        paraBouton_upvote.appendChild(icon_Upvote);

        //création zone photo si photo dispo
        if(URL_photo){ 
                photo_billet = document.createElement("div");
                photo_billet.href="../ressources/img_upload_storage/"+URL_photo;
                photo_billet.title="Agrandir!";
                photo_billet.className="div-img";
                paraURL_photo.appendChild(photo_billet);
                photo_billet_mini= document.createElement("img");
                re = /(?:\.([^.]+))?$/;
                input = URL_photo;
                output = input.substr(0, input.lastIndexOf('.')) || input;
                ext = re.exec(URL_photo)[1]; 
                URL_photo_mini = output+"_min."+ext;
                photo_billet_mini.src="../ressources/img_upload_storage/"+URL_photo_mini;
                photo_billet.appendChild(photo_billet_mini);
        }
        else{
                // AFFICHAGE UNIQUE MINIATURE default si no photo
                photo_billet_mini= document.createElement("img");
                photo_billet_mini.src="../ressources/images/website/img-default-resized.jpg";
                paraURL_photo.appendChild(photo_billet_mini);
        }
         //Creation zone content à gauche de la photo
        var paraDescription_content = document.createElement("div");
        paraDescription_content.id="description_content";
        paraDescription_content.className="description-content";
        
        // creation header description
        var paraHeader_description = document.createElement("div");
        paraHeader_description.className="header_description";
        paraDescription_content.appendChild(paraHeader_description);
        
        //Creation Titre description
        var paraTitre_description = document.createElement("div");
        paraTitre_description.innerHTML="<b>Description</b>";
        paraTitre_description.className="titre_description";
        paraHeader_description.appendChild(paraTitre_description);
        
        //Creation URL zone
        var paraURL_zone = document.createElement("div");
        paraURL_zone.id="URL_zone";
        paraURL_zone.className="URL-zone";
        paraHeader_description.appendChild(paraURL_zone);
        
        //insertion URL web si présent
        if(URL_web!==""){
                var paraURL_web = document.createElement("div");
                paraURL_web.id="URL_web";
                paraURL_web.className="website_description";
                paraURL_zone.appendChild(paraURL_web);

                var URL_web_billet= document.createElement("a");
                URL_web_billet.href="http://"+contenuURL_web;
                paraURL_web.appendChild(URL_web_billet);
                URL_web_billet.appendChild(nodeURL_web);
                URL_web_billet.target="_blank";
        }
        // Zone Description
        paraDescription_content.appendChild(paraZoneDescription);
        if(description===""){
                paraZoneDescription.innerHTML="<i>Description non renseignée</i>";
        }
        //Génération contenu description
        var lines = description.split("\\r\\n"); //Affiche ligne par ligne le textarea
        for(var i=0,l=lines.length;i<l;i++){
                lines[i] = JSON.parse('"' + lines[i].replace(/\"/g, '\\"') + '"');
                paraZoneDescription.innerHTML+=lines[i];
                paraZoneDescription.appendChild(document.createElement("br"));
        }
        
        //Creation de la zone event du billet
        var billet_event = document.createElement("div");
        billet_event.id="billet_event"+compteur_billet+destination;
        billet_event.className="billet_event";
        var billet_event_list = document.createElement("div");
        billet_event_list.id="billet_event_list"+compteur_billet+destination;
        billet_event_list.className="billet_event_list";
        billet_event.appendChild(billet_event_list);
        
        //Creation de la zone footer du billet
        var billet_footer = document.createElement("div");
        billet_footer.id="billet_footer"+compteur_billet+destination;
        billet_footer.className="billet_footer";
        
        //Creation icone report + modifier
        paraBouton_Report.title="Signaler l'annonce";
        var icon_report = document.createElement("i");
        icon_report.className="fa fa-bullhorn";
        var paraBouton_Report_title = document.createElement("div");
        paraBouton_Report_title.className="bouton_report_header_title";        
        paraBouton_Report_title.innerHTML="Signaler";
        paraBouton_Report.appendChild(icon_report);
        paraBouton_Report.appendChild(paraBouton_Report_title);
        paraReport.appendChild(paraBouton_Report);
        
        paraBouton_modifier.title="Modifier l'annonce";
        var icon_modifier = document.createElement("i");
        icon_modifier.className="fa fa-pencil-square-o";
        var paraBouton_modifier_title = document.createElement("div");
        paraBouton_modifier_title.className="bouton_modifier_header_title";
        paraBouton_modifier_title.innerHTML="Modifier";
        paraBouton_modifier.appendChild(icon_modifier);
        paraBouton_modifier.appendChild(paraBouton_modifier_title);  
        paraModifier.appendChild(paraBouton_modifier);

        //Creation d'un billet et des différents zones pour insérer le contenu
        var paraBillet = document.createElement("div");
        paraBillet.id="billet"+compteur_billet+destination;
        paraBillet.className="billet passive-billet collapse in";
        paraBillet.setAttribute("id_lieu",id_lieu);
        paraBillet.setAttribute("numero_billet",compteur_billet);
        paraBillet.setAttribute("nom",nom);
        paraBillet.setAttribute("cours",activiteCours);
        paraBillet.setAttribute("soiree",activiteSoiree);
        var element = document.getElementById(destination);
        element.appendChild(paraBillet);
        
                //Creation de la zone header du billet
                var billet_header = document.createElement("div");
                billet_header.id="billet_header"+compteur_billet+destination;
                paraBillet.appendChild(billet_header);
                
                //Creation billet header left & right
                var billet_header_left = document.createElement("div");
                billet_header_left.className="billet_header_left";
                document.getElementById("billet_header"+compteur_billet+destination).appendChild(billet_header_left);
                var billet_header_right = document.createElement("div");
                billet_header_right.className="billet_header_right";
                document.getElementById("billet_header"+compteur_billet+destination).appendChild(billet_header_right);
                
                if(today<=date_expiration_promotion){
                        billet_header.className="billet_header_pro noselect";
                        var paraSponsor = document.createElement("div");
                        paraSponsor.id="sponsor_header_"+compteur_billet;
                        paraSponsor.className="sponsor_header";
                        paraSponsor.innerHTML='<i class="fa fa-trophy" aria-hidden="true"></i>';
                        paraSponsor.title="Recommandé par lepetitbal";
                        billet_header_right.appendChild(paraSponsor);
                }
                else{
                        billet_header.className="billet_header noselect";     
                }
                //Ajout event lié au marker sur le header left
                $(document).ready(function() {
                        $("#num_marker_"+compteur_billet).parent().on('click', function(event){
                                event.stopPropagation();
                                google.maps.event.trigger(markerList[compteur_billet], 'click');
                        });
                        $("#num_marker_"+compteur_billet).parent().parent().on('click', function(event){
                                if (event.target !== this)
                                return;
                                event.stopPropagation();
                                google.maps.event.trigger(markerList[compteur_billet], 'click');
                        });
                });
                
                //Affichage des infos zone header
                billet_header_left.appendChild(paraNum_billet);
                billet_header_left.appendChild(paraNom);
                billet_header_left.appendChild(paraDistance);
                
                billet_header_right.appendChild(paraActivite);
                billet_header_right.appendChild(paraComment);
                billet_header_right.appendChild(paraUpvote);
                
                //Creation de la zone content du billet
                var billet_content = document.createElement("div");
                billet_content.id="billet_content"+compteur_billet+destination;
                billet_content.className="billet_content collapse";
                billet_content.setAttribute("aria-expanded","true");
                paraBillet.appendChild(billet_content);
                
                //Creation de la zone description du billet
                var billet_description = document.createElement("div");
                billet_description.id="billet_description"+compteur_billet+destination;
                billet_description.className="billet_description";
                billet_content.appendChild(billet_description);
                
                //Affichage des infos zone description
                document.getElementById("billet_description"+compteur_billet+destination).appendChild(paraURL_photo);
                document.getElementById("billet_description"+compteur_billet+destination).appendChild(paraDescription_content);
                if((!description && !URL_photo &&!URL_web) || today>date_expiration_promotion){ //Cache la zone s'il n'y a pas d'infos dedans et si l'event n'est plus en promo
                        billet_description.className+=" hidden";
                }
                //Affichage du contenu zone event
                billet_content.appendChild(billet_event);
                billet_content.appendChild(billet_footer);
                //Creation zone bouton footer
                var billet_bouton_footer= document.createElement("div");
                billet_bouton_footer.className="bouton_footer";
                billet_bouton_footer.appendChild(paraModifier);
                billet_bouton_footer.appendChild(paraReport);

                //Affichage des infos du footer
                document.getElementById("billet_footer"+compteur_billet+destination).appendChild(paraAdresse);
                document.getElementById("billet_footer"+compteur_billet+destination).appendChild(billet_bouton_footer);

        return $('#billet'+compteur_billet+destination);
}

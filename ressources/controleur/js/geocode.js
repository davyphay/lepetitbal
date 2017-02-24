//Renvoie les coordonnes GPS du lieu dans l'input caché "gps" lors du click du bouton et envoi du formulaire si geocoder réussi
// PAGE ACCUEIL et recherche
$(function() {
    $('#btn_rechercher_lieu').click(function() {
        //CHECK SI UNE COMMUNAUTE EST SELECTIONNEE
        //var communaute = document.getElementById('communaute_rechercher_lieu').value;
        //if(communaute!==""){
        if($('input:checkbox').is(':checked')){
            var address = document.forms['form_rechercher_lieu'].adresse_rechercher_lieu.value;
            var geocoder = new google.maps.Geocoder(); // "Geocoder"
            geocoder.geocode({'address': address}, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    var latlng = (results[0].geometry.location);
                    document.forms['form_rechercher_lieu'].gps_rechercher_lieu.value=latlng;
                    $('#form_rechercher_lieu').trigger('submit');
                }
                else {alertify.alert("Attention !",'Aucun lieu n\'a été trouvé');
                    document.forms["form_rechercher_lieu"].gps_rechercher_lieu.value="";
                    return false;
                }
            });
        }
        else{
            alertify.alert("Attention !",'Veuillez choisir un type danse.');
            return false;
        }
    });
});
$(function() {
    $('#geolocator').click(function() {
        //CHECK SI UNE COMMUNAUTE EST SELECTIONNEE
        //var communaute = document.getElementById('communaute_rechercher_lieu').value;
        //if(communaute!==""){
        if($('input:checkbox').is(':checked')){
            if(navigator.geolocation) {
                window.loading_screen = window.pleaseWait({
                logo: "https://www.lepetitbal.com/ressources/images/website/lepetitbal-logo-mini.png",
                backgroundColor: 'rgb(191,51,36)',
                loadingHtml: '<div class="sk-spinner sk-spinner-pulse"></div><p class="loading-message">Géolocalisation en cours...</p>'});
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                    document.forms['form_rechercher_lieu'].gps_rechercher_lieu.value=pos;
                    //Reverse geocoding
                    // This is making the Geocode request
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({ 'latLng': pos }, function (results, status) {
                        // This is checking to see if the Geocode Status is OK before proceeding
                        if (status == google.maps.GeocoderStatus.OK) {
                            var address = (results[0].formatted_address);
                            document.forms['form_rechercher_lieu'].adresse_rechercher_lieu.value=address;
                            $('#form_rechercher_lieu').trigger('submit');
                        }
                        else{
                            window.loading_screen.finish();
                            alertify.alert("Attention !",'Aucun lieu n\'a été trouvé');
                            document.forms["form_rechercher_lieu"].adresse_rechercher_lieu.value="";
                            return false;
                        }
                    });
                }, function() {
                    handleNoGeolocation(true);
                });
            }
            else {
                // Browser doesn't support Geolocation
                handleNoGeolocation(false);
            }
        }
        else{
            alertify.alert("Attention !",'Veuillez choisir un type danse.');
            return false;
        }
    });
});

function handleNoGeolocation(errorFlag) {
    var content="";
  if (errorFlag){
    content = 'La géolocalisation a échoué';
  }
  else {
    content = 'Votre navigateur ne supporte pas la géolocalisation';
  }
  window.loading_screen.finish();
  alertify.alert(content);
  return false;
}

// PAGE RECHERCHE ANNONCEUR
//Renvoie les coordonnes GPS du lieu dans l'input caché "gps" lors du click du bouton et envoi du formulaire si geocoder réussi
$(function() {
    $('#btn_ajout_lieu').click(function() {
        //CHECK SI UNE COMMUNAUTE EST SELECTIONNEE
        if($('#nom_lieu').val() !==''){
            if ($('input[name=communaute_lieu_salsa]').is(':checked') || $('input[name=communaute_lieu_bachata]').is(':checked') || $('input[name=communaute_lieu_kizomba]').is(':checked') || $('input[name=communaute_lieu_rock4T]').is(':checked') || $('input[name=communaute_lieu_rock6T]').is(':checked') || $('input[name=communaute_lieu_swing]').is(':checked') || $('input[name=communaute_lieu_wcs]').is(':checked') || $('input[name=communaute_lieu_tango]').is(':checked') || $('input[name=communaute_lieu_salon]').is(':checked')){
                if ($('input[name=activite_cours]').is(':checked') || $('input[name=activite_soiree]').is(':checked') || $('input[name=activite_event]').is(':checked')){ 
                    var address = document.forms['form_ajout_lieu'].adresse_lieu.value;
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({'address': address}, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) { 
                            document.forms["form_ajout_lieu"].gps_lieu.value=results[0].geometry.location;
                            $('#form_ajout_lieu').trigger('submit');
                        }
                        else {alertify.alert("Attention !",'Aucun lieu n\'a été trouvé');
                            document.forms["form_ajout_lieu"].gps_lieu.value="";
                            return false;
                        }
                    });
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

//Renvoie les coordonnes GPS du lieu dans l'input caché "gps" lors du click du bouton et envoi du formulaire si geocoder réussi
$(function() {
    $('#btn_modifier_lieu').click(function() {
        //CHECK SI UNE COMMUNAUTE EST SELECITONEE AU MINI
        if($('#nom_lieu_modif').val() !==''){
            if ($('input[name=communaute_lieu_salsa]').is(':checked') || $('input[name=communaute_lieu_bachata]').is(':checked') || $('input[name=communaute_lieu_kizomba]').is(':checked') || $('input[name=communaute_lieu_rock4T]').is(':checked') || $('input[name=communaute_lieu_rock6T]').is(':checked') || $('input[name=communaute_lieu_swing]').is(':checked') || $('input[name=communaute_lieu_wcs]').is(':checked') || $('input[name=communaute_lieu_tango]').is(':checked') || $('input[name=communaute_lieu_salon]').is(':checked')){
                if ($('input[name=activite_lieu_cours]').is(':checked') || $('input[name=activite_lieu_soiree]').is(':checked') || $('input[name=activite_lieu_event]').is(':checked')){    
                    if($(this).closest('form').data('changed')) {
                        var address = $('#adresse_lieu_modif').val();
                        var geocoder = new google.maps.Geocoder();
                        geocoder.geocode({'address': address}, function(results, status) {
                            if (status === google.maps.GeocoderStatus.OK) { 
                                document.forms["form_modifier_lieu"].gps_lieu.value=results[0].geometry.location;
                                $('#form_modifier_lieu').trigger('submit');
                            }
                            else {alertify.alert("Attention !",'Aucun lieu n\'a été trouvé'); // A remplacer par un message d'erreur
                                 document.forms["form_modifier_lieu"].gps_lieu.value="";
                                  return false;
                                 }
                        });
                    }
                    else{
                        alertify.alert("Attention !",'Aucun champ n\'a été modifié');
                        return false;
                    }
                }
                else{
                    alertify.alert("Attention !",'Au moins une activité doit être sélectionnée.');
                    return false;
                }
            }
            else{
                alertify.alert("Attention !",'Vous devez choisir au moins une communauté de danse');
                return false;
            }
        }
        else{
            alertify.alert("Attention !",'Vous devez saisir un nom de lieu');
            return false;
        }
    });    
});
// EVENTS
$(function(){
    $('#btn_ajouter_evenement').click(function() {
        // check si les inputs sont remplis
        if ($('input[name=id_lieu_add').is(':checked')) {
            if($('#date_evenement_add').val() !==''){
                if($('#heure_debut_evenement_add').val() !==''){
                    if($('#heure_fin_evenement_add').val() !==''){
                        if($('#titre_evenement_add').val() !==''){
                            if($('#danse_pratique_evenement_add').val() !==''){
                                if($('#tarifs_evenement_add').val() !==''){
                                    if($('input[name=communaute_evenement_salsa_add]').is(':checked') || $('input[name=communaute_evenement_bachata_add]').is(':checked') || $('input[name=communaute_evenement_kizomba_add]').is(':checked') || $('input[name=communaute_evenement_rock4T_add]').is(':checked') || $('input[name=communaute_evenement_rock6T_add]').is(':checked') || $('input[name=communaute_evenement_swing_add]').is(':checked') || $('input[name=communaute_evenement_wcs_add]').is(':checked') || $('input[name=communaute_evenement_tango_add]').is(':checked') || $('input[name=communaute_evenement_salon_add]').is(':checked')){
                                        if($('#nb_jetons_utilise_event').val() !==''){
                                            string_nb_jetons_dispo =$('#nb_jetons_dispo').val();
                                            nb_jetons_dispo = parseInt(string_nb_jetons_dispo);
                                            nb_jeton_utilise_event=$('#nb_jetons_utilise_event').val();
                                            nb_evenement =$('#nb_event').val();
                                            //if(nb_jetons_dispo>=nb_jeton_utilise_event){
                                                if($('#nouveau_lieu').is(':checked')){
                                                    if($('#nom_lieu_evenement_add').val()!==''){
                                                        if($('#adresse_lieu_event').val()!==''){
                                                            var address = $('#adresse_lieu_event').val();
                                                            var geocoder = new google.maps.Geocoder();
                                                            geocoder.geocode({'address': address}, function(results, status) {
                                                                if (status === google.maps.GeocoderStatus.OK) { 
                                                                    document.forms["form_ajouter_event"].gps_lieu_event.value=results[0].geometry.location;
                                                                    alertify.confirm('Confirmation d\'ajout d\'évènement',
                                                                        'Êtes-vous sûr(e) de vouloir ajouter '+nb_evenement+' évènement(s)? Vous pouvez modifier les informations ultérieurement à tout moment.',
                                                                        function(){$('#form_ajouter_event').submit();},
                                                                        function(){alertify.error('Opération annulée');}
                                                                    );
                                                                }
                                                                else {alertify.alert("Attention !",'Aucun lieu n\'a été trouvé'); // A remplacer par un message d'erreur
                                                                     document.forms["form_ajouter_event"].gps_lieu_event.value="";
                                                                      return false;
                                                                     }
                                                            });                                                        
                                                        }
                                                        else{
                                                        alertify.alert("Attention !",'Vous devez saisir une adresse pour l\'évènement!');
                                                        return false;  
                                                        }
                                                    }
                                                    else{
                                                        alertify.alert("Attention !",'Vous devez saisir un lieu pour l\'évènement!');
                                                        return false;  
                                                    }
                                                }
                                                else{
                                                    alertify.confirm('!Confirmation d\'ajout d\'évènement',
                                                        'Êtes-vous sûr(e) de vouloir ajouter '+nb_evenement+' évènement(s)? Vous pouvez modifier les informations ultérieurement à tout moment.',
                                                        function(){$('#form_ajouter_event').submit();},
                                                        function(){alertify.error('Opération annulée');}
                                                    );
                                                }
                                           /* }
                                            else{
                                                alertify.alert("Attention !",'Vous ne disposez pas d\'assez de jetons!');
                                                return false; 
                                            }*/
                                        }
                                        else{
                                            alertify.alert("Attention !",'Coût en jeton invalide!');
                                            return false;   
                                        }
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
                alertify.alert("Attention !",'Vous devez saisir au moins une date!');
                return false;  
            }
        }
        else{
            alertify.alert("Attention !",'Vous devez indiquer un nom de lieu!');
            return false;
        }
    });
});

// Si un champ a été modifié, modifie le data du form
$(document).on('change', 'form :input', function() {
    $(this).closest('form').data('changed', true);
});

// Si changement champ modifier lieu tableau cours
$('#liste_cours_hebdo').on('change', ':input', function(){
       $('#cours_changement').val("yes");
});
$('#liste_soiree_hebdo').on('change', ':input', function(){
       $('#soiree_changement').val("yes");
});






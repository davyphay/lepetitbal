$(document).ready(function() {
    $("#affection_proprio_lieu").autocomplete({
         serviceUrl: '../ressources/modele/get_nom_organisation.php',
         dataType: 'json',
         minChars: 3
    });   
});

$(document).ready(function() {
    $("#revendiquer_nom_lieu").autocomplete({
         serviceUrl: '../ressources/modele/get_nom_organisation.php',
         dataType: 'json',
         minChars: 3
    });   
});

$(document).ready(function() {
    $("#nom_lieu_evenement_recherche").autocomplete({
         serviceUrl: '../ressources/modele/get_nom_organisation_no_proprio.php',
         dataType: 'json',
         minChars: 3
    });   
});
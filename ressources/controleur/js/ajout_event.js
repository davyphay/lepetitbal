$(document).ready(function() {
	$('#date_evenement_add').on("focusout",function(){
		var dates = $(this).multiDatesPicker('getDates',"object");
		var nb_event = dates.length;
		$('#nb_event').val(nb_event);
		string_cout_jeton_unitaire = $("#cout_jeton").val();
		cout_jeton_unitaire = parseInt(string_cout_jeton_unitaire);
		var cout_total = nb_event * cout_jeton_unitaire;
		$('#nb_jetons_utilise_event').val(cout_total);
		string_nb_jeton_max = $("#nb_jetons_dispo").val();
		nb_jeton_max = parseInt(string_nb_jeton_max);
		if(nb_jeton_max<0){
			alertify.alert("Vous devez disposer d'au moins 5 jetons pour pouvoir créer un nouvel évènement.");
		}
		});
});

$(function() {
	var today=new Date();
	var date_limite = new Date();
	date_limite.setDate(today.getDate() + 365);
	string_cout_jeton_unitaire = $("#cout_jeton").val();
	cout_jeton_unitaire = parseInt(string_cout_jeton_unitaire);
	string_nb_jeton_max = $("#nb_jetons_dispo").val();
	nb_jeton_max = parseInt(string_nb_jeton_max);
	nb_semaine_max = Math.floor(nb_jeton_max/cout_jeton_unitaire);
	$('#date_evenement_add').multiDatesPicker({
		dateFormat: "dd-m-yy",
		minDate: 0,
		maxDate: 365,
		maxPicks: nb_semaine_max,
	});
	// FIX issue for jumping
	$.datepicker._selectDateOverload = $.datepicker._selectDate;
	$.datepicker._selectDate = function (id, dateStr) {
	  var target = $(id);
	  var inst = this._getInst(target[0]);
	  inst.inline = true;
	  $.datepicker._selectDateOverload(id, dateStr);
	  inst.inline = false;
	  if (target[0].multiDatesPicker !== null) {
		target[0].multiDatesPicker.changed = false;
	  } else {
		target.multiDatesPicker.changed = false;
	  }
	  this._updateDatepicker(inst);
	};
});

$(function() {
        var today=new Date();
		var date_limite = new Date();
		date_limite.setDate(today.getDate() + 365);		
        $("#date_evenement").datepicker(({dateFormat: 'dd-mm-yy',minDate:today,maxDate: date_limite}));
});

$(document).ready(function() {
   $('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'nouveau_lieu') {
            $('#zone-nouveau_lieu').collapse("show");
       }
       else {
            $('#zone-nouveau_lieu').collapse("hide");
       }
   });
});

$(document).ready(function() {
   $('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'recherche_lieu') {
            $('#zone-recherche_lieu').collapse("show");
       }
       else {
            $('#zone-recherche_lieu').collapse("hide");
       }
   });
});
$(document).ready(function() {
	// Trouve la bonne date de fin de promo + fixe les limites du date picker
	date = $("#date_fin_promotion_bdd").val();
	date_fin_promotion = new Date(date);
	date_limite = new Date(date);
	nb_jeton_max_max = parseInt($("#nb_jetons_utilise").attr('max'));
	date_limite.setDate(date_limite.getDate()+nb_jeton_max_max);
	$.datepicker.setDefaults($.datepicker.regional['fr']);
    $("#date_picker" ).datepicker(({
		dateFormat: 'dd-mm-yy',
		minDate: date_fin_promotion,
		maxDate: date_limite,
	}));
		$("#date_picker").datepicker('setDate', date_fin_promotion);
});

$(document).ready(function() {
	$(".inc").click(function() {
		incrementation();
	});
	$(".dec").click(function() {
		decrementation();
	});
});
// on change value input box agit sur le date picker
$(document).ready(function() {
	$("#nb_jetons_utilise").on('change',function() {
		nb_jeton = parseInt($(this).val());
		nb_jeton_max = $("#nb_jetons_utilise").attr('max');
		date=$("#date_fin_promotion_bdd").val();
		date_fin_promotion = new Date(date);
		if(nb_jeton>=0){
			if(nb_jeton<=nb_jeton_max){
				date_fin_promotion.setDate(date_fin_promotion.getDate ()+nb_jeton);
				$("#date_picker").datepicker('setDate', date_fin_promotion);
			}
			else{
				$("#nb_jetons_utilise").val(nb_jeton_max);
				date_fin_promotion.setDate(date_fin_promotion.getDate ()+nb_jeton_max);
				$("#date_picker").datepicker('setDate', date_fin_promotion);
			}
		}
	});
});
//on change value datepicker => agit sur value input box
$(document).ready(function() {
	$("#date_picker").on('change',function() {
		date_picker = $(this).val();
		var s = date_picker;
		if (s) { 
			s = s.replace(/(\d{1,2})-(\d{1,2})-(\d{4})/, function(match,d,m,y) { 
				return y + '-' + m + '-' + d;  
			});
		}
		date_convertie = new Date(s);
		date = $("#date_fin_promotion_bdd").val();		
		date_fin_promotion = new Date(date);
		difference = (date_convertie - date_fin_promotion)/(1000*3600*24);
		$("#nb_jetons_utilise").val(difference);
	});
});

// prevent of non numeric values + enter
$(document).ready(function() {
	document.querySelector("#nb_jetons_utilise").addEventListener("keypress", function (evt) {
		if ((evt.which >= 48 && evt.which <=57) || evt.which == 8 || evt.which == 46 || evt.which == 13){
			if(evt.which == 13){
				$(this).blur();
			}
		}
		else{
			evt.preventDefault();
		}
	});
});

function incrementation(){
	//incrémentation dans la zone texte
	string_val = $("#nb_jetons_utilise").val();
	nb_jeton = parseInt(string_val);
	nb_jeton_max = $("#nb_jetons_utilise").attr('max');
	if(nb_jeton<nb_jeton_max){
		nb_jeton++;
		$("#nb_jetons_utilise").val(nb_jeton);
		$("#nb_jetons_utilise").trigger('change');
	}
}

function decrementation(){
	string_val = $("#nb_jetons_utilise").val();
	nb_jeton = parseInt(string_val);
	if(nb_jeton>0){
		nb_jeton--;
		$("#nb_jetons_utilise").val(nb_jeton);
		$("#nb_jetons_utilise").trigger('change');
	}
}

// mouse hold on click incrémentation
var step = 40;
var delay = 400;
var timeout,timer, clicker = $('.inc');
clicker.mousedown(function(){
	timer = setTimeout(function(){
        timeout = setInterval(function(){
			incrementation();
		}, step);
		return false;
    }, delay);
	return false;
});
// mouse hold on click decrementation
clicker2 = $('.dec');
clicker2.mousedown(function(){
	timer = setTimeout(function(){
		timeout = setInterval(function(){
			decrementation();
		}, step);
		return false;
	}, delay);
	return false;
});
// pour les 2
$(document).mouseup(function(){
    clearInterval(timeout);
	clearTimeout(timer);
    return false;
});


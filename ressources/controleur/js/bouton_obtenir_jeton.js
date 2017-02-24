$(document).ready(function() {
	$('.bouton_obtenir_jeton').on('click',function(){
		$('#achat_jeton').addClass("active");
		$('#achat_jeton_li').addClass("active");
		
		$('#ajouter_lieu').removeClass("active");
		$('#ajouter_lieu_li').removeClass("active");
		
		$('#parametre').removeClass("active");
		$('#parametre_li').removeClass("active");
		
		$("#espaceMembreModal").modal('show');
	});
});

$(document).ready(function() {
	$('#bouton_obtenir_jeton_espace_membre').on('click',function(){
		$('#achat_jeton-taba').click();
	});
});
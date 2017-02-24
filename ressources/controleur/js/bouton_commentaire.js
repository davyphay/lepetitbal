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

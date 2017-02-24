$(document.body).on('click', '#modifier_commentaire' ,function(){
	id_commentaire=$(this).attr("value");
	$('#id_commentaire').val(id_commentaire);
	adresse_email_commentaire=$('#email_membre_input').val();
	$('#adresse_email_commentaire').val(adresse_email_commentaire);
	
	var divHtml = $(this).parent().prev('div').html();
	$('#html_old').val(divHtml);
	var editableText = $("<textarea />");
	editableText.val(divHtml);
	$(this).parent().prev('div').replaceWith(editableText);
	editableText.focus();
	// setup the blur event for this new textarea
	editableText.blur(editableTextBlurred);
});


$(document.body).on('click', '#supprimer_commentaire' ,function(){
	$('#modifier_commentaire_type').val("supprimer");
	id_commentaire=$(this).attr("value");
	$('#id_commentaire').val(id_commentaire);
	adresse_email_commentaire=$('#email_membre_input').val();
	$('#adresse_email_commentaire').val(adresse_email_commentaire);
	alertify.confirm('Confirmation de la suppression',
		'Êtes-vous sûr(e) de vouloir supprimer ce commentaire?',
		function(){
			$('#form_modifier_commentaire').submit();
		},
		function(){
			alertify.error('Opération annulée');
			$('#id_commentaire').val("");
			$('#adresse_email_commentaire').val("");
			$('#modifier_commentaire_type').val("");
		}
	);
});

function editableTextBlurred() {
    var html = $(this).val();
	var html_old = $('#html_old').val();
	$('#modifier_commentaire_content').val(html);
	$('#modifier_commentaire_type').val("modifier");
    var viewableText = $("<div>");
    viewableText.html(html);
    $(this).replaceWith(viewableText);
	if(html_old !== html){
		$('#form_modifier_commentaire').submit();
	}
	else{
		$('#html_old').val("");
		$('#id_commentaire').val("");
		$('#adresse_email_commentaire').val("");
		$('#modifier_commentaire_type').val("");
		$('#modifier_commentaire_content').val("");
	}
}

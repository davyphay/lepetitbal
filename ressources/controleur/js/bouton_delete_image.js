$('input[type=file]').change(function(){
	$('.form-control-clear').toggleClass('hidden');
	var files = $(this)[0].files;
    if (files.length > 0) {
		// On part du principe qu'il n'y qu'un seul fichier
		// étant donné que l'on a pas renseigné l'attribut "multiple"
		var file = files[0],
		$image_preview = $('#image_preview');
		$image_preview.find('.thumbnail').removeClass('hidden');
		$image_preview.find('img').attr('src', window.URL.createObjectURL(file));
	}
});
$(document).ready(function(){
	$('#feedback').on('click',function(){
		// RAZ des données du filestyle
		$(":file").filestyle('clear');
		//RAZ image preview
		$('#image_preview').find('.thumbnail').addClass('hidden');
		//RAZ balise change detection
		$(this).closest('form').data('changed', true);
		//RAZ input image default
		$('#image_lieu_old').val("");
		//Suppression du bouton delete
		$('.form-control-clear').toggleClass('hidden');
	});
});
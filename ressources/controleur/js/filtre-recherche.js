// Bouton pour tout afficher
$(document).ready(function() {
	$('#box9').on('click', function() {
      if($(this).attr("value")=="show"){
         $(this).attr("value","hidden");
         $(".billet_content").collapse("hide");
      }
      else if($(this).attr("value")=="hidden"){
         $(this).attr("value","show");
         $(".billet_content").collapse("show");
      }
	$("#hideall").toggleClass("fa-compress");
	$("#hideall").toggleClass("fa-expand");
   });
});
$(document).ready(function() {
	$('#zone_filtre').on('click', function(event){
		event.stopPropagation();
	});
});

$(document).ready(function() {
   $('body').on('change', '#nb_jour_calendrier_input', function() {
      nb_jour_calendrier = $('#nb_jour_calendrier_input').val();
      $('#nb_jour_calendrier').val(nb_jour_calendrier);
      $('#form_rechercher_lieu').submit();
   });
});




$(document).ready(function() {
	$('body').on('click', '.bouton_report_header', function(event) {
		event.stopPropagation();
		
		var id_lieu="";
		id_lieu=parseInt($(this).closest(".billet").attr('id_lieu'));
        $('#espaceReportModal').find("#lieu_report").val(id_lieu);
		
		var numero_billet="";
		numero_billet=parseInt($(this).closest(".billet").attr('numero_billet'));
		$('#espaceReportModal').find("#numero_billet_report").val(numero_billet);
		
		var nom_lieu="";
		nom_lieu=$(this).closest(".billet").attr('nom');
		$('#espaceReportModal').find("#name_report").val(nom_lieu);
		$('#espaceReportModal').find("#nom_lieu_report").val(nom_lieu);
		
		$("#espaceReportModal").modal('show');
	});
});

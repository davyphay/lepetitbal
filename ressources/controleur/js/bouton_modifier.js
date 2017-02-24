function bouton_modifier(id_lieu){
	var session = document.getElementById("sess_var").value;
	if(session=="yes"){
		window.location.href = '/modifier/?id_lieu='+id_lieu;		
	}
	else if (session=="no"){
		alertify.alert("Attention!","Vous devez vous connecter pour modifier le lieu");
	}
}

$(document).ready(function() {
	$('body').on('click', '.bouton_modifier_header', function(event) {
		event.stopPropagation();
		var id_lieu="";
		id_lieu=parseInt($(this).closest(".billet").attr('id_lieu'));
        $('#espaceReportModal').find("#lieu_commentaire").val(id_lieu);
		
		bouton_modifier(id_lieu);
	});
});
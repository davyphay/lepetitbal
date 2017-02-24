$(document).ready(function() {
   $('input[type="radio"]').click(function() {
       if($(this).attr('id') == 'nouveau_lieu_devenir_annonceur') {
            $('#zone-nouveau_lieu').collapse("show");
       }
       else {
            $('#zone-nouveau_lieu').collapse("hide");
       }
	   
	   if($(this).attr('id') == 'revendiquer_lieu'){
			$('#zone-revendiquer_lieu').collapse("show");
	   }
	   else{
			$('#zone-revendiquer_lieu').collapse("hide");
	   }
   });
});
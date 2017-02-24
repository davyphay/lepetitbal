$(document).ready(function() {
   $('body').on('click', '#espace_CGU', function() {
      if($("#espace_CGU_content").hasClass("collapse") && !$("#espace_CGU_content").hasClass("in")){
         $("#espace_CGU_content").collapse("show");
		 $(this).find("i").removeClass("fa-angle-down").addClass("fa-angle-up");
      }
      else{
        $("#espace_CGU_content").collapse("hide");
		$(this).find("i").removeClass("fa-angle-up").addClass("fa-angle-down");
      }
   });
});

$(document).ready(function() {
   $('body').on('click', '#espace_CGV', function() {
      if($("#espace_CGV_content").hasClass("collapse") && !$("#espace_CGV_content").hasClass("in")){
         $("#espace_CGV_content").collapse("show");
		 $(this).find("i").removeClass("fa-angle-down").addClass("fa-angle-up");
      }
      else{
        $("#espace_CGV_content").collapse("hide");
		$(this).find("i").removeClass("fa-angle-up").addClass("fa-angle-down");
      }
   });
});
$(document.body).on('click', '.caret-switch' ,function(){
	$(this).parent().find('.fa').toggleClass('fa-caret-up fa-caret-down');
});

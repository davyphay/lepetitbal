/*
	Dropdown with Multiple checkbox select with jQuery - May 27, 2013
	(c) 2013 @ElmahdiMahmoud
	license: http://www.opensource.org/licenses/mit-license.php
*/

$(".dropdown2 dt a").on('click', function() {
  $(".dropdown2 dd ul").slideToggle('fast');
});

$(".dropdown2 dd ul li a").on('click', function() {
  $(".dropdown2 dd ul").hide();
});

function getSelectedValue(id) {
  return $("#" + id).find("dt a span.value").html();
}

$(document).on('click', function(e) {
  var $clicked = $(e.target);
  if (!$clicked.parents().hasClass("dropdown2")) $(".dropdown2 dd ul").hide();
});

$('.mutliSelect input[type="checkbox"]').on('click', function() {

  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val();
  title = $(this).val() + ",";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSel').append(html);
    $(".hida").hide();
  } else {
    $('span[title="' + title + '"]').remove();
    var ret = $(".hida");
    $('.dropdown2 dt a').prepend(ret);
  }
	if ($('.multiSel').is(':empty')){
		$('.hida').show();
	}
});

$(function() {
    $('.bouton-ok').click(function() {
			$(".dropdown2 dd ul").hide();
		});
});

$(function() {
    $('.bouton-lancer').click(function() {
			$("#form_rechercher_lieu").submit();
		});
});
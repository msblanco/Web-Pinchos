
$(document).ready(function(){/* off-canvas sidebar toggle */

$('#Login').click(function() {
  $("#header").hide().fadeOut("slow");
  $("#loginModal").css("visibility", "visible");
});

$('#Registro').click(function() {
  $("#header").hide().fadeOut("slow");
  $("#registroModal").css("visibility", "visible").fadeIn("slow");
});

$('.inicio').click(function() {
  $("#loginModal").css("visibility", "hidden");
  $("#registroModal").css("visibility", "hidden");
  $("#header").css("visibility", "visible").fadeIn("slow");
});

$('[data-toggle=offcanvas]').click(function() {
  $(this).toggleClass('visible-xs text-center');
  $(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
  $('.row-offcanvas').toggleClass('active');
  $('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
  $('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
  $('#btnShow').toggle();
});
});

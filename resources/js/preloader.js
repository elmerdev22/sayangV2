/*=====================================
  Preloader JS
======================================*/ 	
//After 2s preloader is fadeOut
$('.preloader').delay(2000).fadeOut('slow');
setTimeout(function() {
//After 2s, the no-scroll class of the body will be removed
$('body').removeClass('no-scroll');
}, 2000); //Here you can change preloader time
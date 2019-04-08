$(document).ready(function() {   
   $('.menu-collapse').find('.sub-menu').hide();
   
   $('.toggle-menu').click(function() {
      if ($(this).parent().parent().hasClass('menu-collapse')) {
         $(this).parent().parent().removeClass('menu-collapse').addClass('menu-expand');
         $(this).parent().parent().find('.sub-menu').slideDown();
      } else {
         $(this).parent().parent().removeClass('menu-expand').addClass('menu-collapse');
         $(this).parent().parent().find('.sub-menu').slideUp();
      }
   });
});
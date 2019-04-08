$(document).ready(function(){

	$("div.radio .shipping-option").shippingOption();
	
	if ($('#OrdersShippingAddressOption0').is(':checked')) {
      $('.shipping_address').css('display', 'none');
   }

});

$.fn.bidang = function() {

	$(this).click(function(){      
      if ($('#OrdersShippingAddressOption0').is(':checked')) {
         $('.shipping_address').css('display', 'none');
      } else if ($('#OrdersShippingAddressOption1').is(':checked')) {
         $('.shipping_address').css('display', 'block');
      }
	});

}

$.fn.unit = function() {
   $(this).click(function() {
      $('#UserSatkerKdSubUnit').load();
   }
}
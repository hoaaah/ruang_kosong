$.fn.changeSelect = function(target, url, options) {

	$(this).change(function(){ 
      
      options = jQuery.extend({
         params: {
            'lkegiatans':null,
            'provinces':null
         },
         before: null,
         after: null,
      },
      options);
      
      var _params = '/';
      $.each(options.params, function(key, val) {
         if (val != null) {
            var _val = ($(val).val() != null ? $(val).val() : '');
            _params += key+':'+_val+'/';
         }
      })
      	
      if ($(this+':selected').val() != '') {
         var _url = url + _params;
         
         if (options.before != null) {
            options.before();
         }
         
         $(target).html('').load(_url, function() {

            if (options.after != null) {
               options.after();
            }
            
         });
         $(target).change();
         
      } else {
         $(target).html('');
         $(target).change();
      }
	});

}
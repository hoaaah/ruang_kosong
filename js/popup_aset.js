$('#popup-aset').ready(function() {   
   $("#popup-aset a").click(function() {
      return false;
   });
   
   $("#popup-aset .pilih-button").click(function() {
      var url = this.href;
      
      $("#popup-aset").load(url + ' #popup-aset', function() {
         $(document).ready(function() {
            $("#popup-aset a").click(function() {
               return false;
            });
         });
      });
      //alert(url);
   });
});
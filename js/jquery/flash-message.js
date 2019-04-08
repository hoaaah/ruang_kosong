$(document).ready(function() { 

   //with this approach you can assign the jQuery Tools API to be used later
  //otherwise you could use a standard one-liner:
  //$('#flash-message').expose().load();
   var flashMessage = $('#flash-message').expose({api: true}); 

   //now that we have a direct access to the API through the "flashMessage" object
   //we can call the jQuery Tools methods
   //such as load(), which is required to show/expose our modal
   flashMessage.load();

   //now that the modal is displayed we can create a simple way to automatically
   //remove it after 3 seconds
   flashMessage.onLoad(function() {
     setTimeout(function() {
          flashMessage.close();
          $('#flash-message').slideUp(500);
      }, 3000);
   });

});
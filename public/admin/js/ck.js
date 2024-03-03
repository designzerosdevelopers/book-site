
  ClassicEditor
      .create(document.querySelector('#editor'))
      .then(editor => {
          console.log(editor);
      })
      .catch(error => {
          console.error(error);
      });

  $(document).ready(function(){
       // Automatically hide the status message alert after 3 seconds
       $("#updateSuccessAlert").fadeTo(3000, 500).slideUp(500, function(){
          $("#updateSuccessAlert").slideUp(500);
      });
  });

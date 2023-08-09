$(document).ready(function(){
    $("#img").on("change", function(event) {
        var selectedFile = event.target.files[0];

        // $("#texto").text("Selected file: " + selectedFile);
        if (selectedFile) {
            var reader = new FileReader();
      
            reader.onload = function(event) {
              var imageUrl = event.target.result;
              $("#img-view").html("<img id='imagen' src='" + imageUrl + "' class='w-100' style='width:100px'>");;
            };
      
            reader.readAsDataURL(selectedFile);
          } 

       
      });

       $("#drop-area").on("dragover", function(event) {
        event.preventDefault();
    });
      $("#drop-area").on("drop", function(event) {
        event.preventDefault();
        // $("#input-file").prop("files", droppedFiles); // Set the files property
        var droppedFile = event.originalEvent.dataTransfer.files;
        $("#img-input").prop("files", [droppedFile][0]);
        console.log([droppedFile][0][0]);

        var reader = new FileReader();
      
        reader.onload = function(event) {
          var imageUrl = event.target.result;
          

          $("#img-view").html("<img id='imagen' src='" + imageUrl + "' class='w-100' style='width:100px'>");;

        };
  
        reader.readAsDataURL(droppedFile[0]);
   
    });

});


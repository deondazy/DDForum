$(document).ready(function() {
  var input = document.getElementById("user-avatar"), formdata = false;
        
  if (window.FormData) {
    formdata = new FormData();
  }
  
  function showUploadedItem (source) {
    var display = document.getElementById("show-avatar"),
        img  = document.createElement("img");
        img.src = source;
        display.innerHTML = "";
        display.appendChild(img);
  }

  if (input.addEventListener) {
    input.addEventListener("change", function (evt) {
      var img, reader, file;
    
      file = this.files[0];
  
      if ( !file.type.match(/image.*/) ) { 
        document.getElementById("show-avatar").innerHTML = "";
        document.getElementById("response").innerHTML = "That's not an image";
        return;
      }
      else {
         document.getElementById("response").innerHTML = "";
      }

      if ( window.FileReader ) {
        reader = new FileReader();
        reader.onloadend = function (e) {
          showUploadedItem(e.target.result);
        };
        reader.readAsDataURL(file);
      }
      
    }, false);
  }
});
function validateForm(event) {
    event.preventDefault();
  console.log(event)
  var name = document.forms["submit"]["service_name"].value.trim();
    var imageInput = document.forms["submit"]["image"];
    var description = document.forms["submit"]["description"].value.trim();
    var name_error = document.getElementById("name_error");
    var image_error = document.getElementById("image_error");
    var description_error = document.getElementById("description_error");
    var isValid = true; // Flag to track overall form validity

    // Clear previous error messages
    name_error.innerHTML = '';
    image_error.innerHTML = '';
    description_error.innerHTML = '';

    // Validate service name
    if (name === '') {
      name_error.innerHTML = 'Please enter a service name.';
      isValid = false;
    }

    // Validate image (required)
    if (imageInput.files.length === 0) {
      image_error.innerHTML = 'Please choose an image.';
      isValid = false;
    } else {
      var file = imageInput.files[0];
      var fileSize = file.size; // Size in bytes
      var fileExtension = file.name.split('.').pop().toLowerCase(); // Get file extension

      // Validate image size (in bytes) - adjust the maximum size as needed
      var maxSizeBytes = 4 * 1024 * 1024; // 4 MB (4 * 1024 * 1024 bytes)
      if (fileSize > maxSizeBytes) {
        image_error.innerHTML = 'Please choose an image with a maximum size of 5 MB.';
        isValid = false;
      }

      // Validate image extension - adjust the allowed extensions as needed
      var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
      if (!allowedExtensions.includes(fileExtension)) {
        image_error.innerHTML = 'Please choose a valid image file (JPG, JPEG, PNG, GIF).';
        isValid = false;
      }
    }

    // Validate description word count (50 to 100 words)
    var minWords = 20;
    var maxWords = 100;
    var descriptionWords = description.split(/\s+/).filter(function(word) {
      return word.length > 0;
    }).length;

    if (descriptionWords < minWords || descriptionWords > maxWords) {
      description_error.innerHTML = 'Please enter a description with ' + minWords + ' to ' + maxWords + ' words.';
      isValid = false;
    }

    if (isValid) {
      // No validation errors, allow form submission
      return true;
    } else {
      // Validation errors present, prevent form submission
      event.preventDefault();
      return false;
    }
   
  }
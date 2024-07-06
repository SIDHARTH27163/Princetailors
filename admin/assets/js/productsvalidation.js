function validateForm(event) {
    var product_name = document.forms["submit"]["product_name"].value.trim();
    var imageInput = document.forms["submit"]["image"];
    var heading = document.forms["submit"]["heading"].value.trim();
    var category = document.forms["submit"]["category"].value.trim();
    var description = document.forms["submit"]["description"].value.trim();
    var product_name_error = document.getElementById("product_name_error");
    var image_error = document.getElementById("image_error");
    var description_error = document.getElementById("description_error");
    var category_error = document.getElementById("category_error");
    var isValid = true; // Flag to track overall form validity

    // Clear previous error messages
    product_name_error.innerHTML = '';
    image_error.innerHTML = '';
    description_error.innerHTML = '';
heading_error.innerHTML="";
    // Validate service name
    if (product_name === '') {
      product_name_error.innerHTML = 'Please enter a product name.';
      isValid = false;
    }
    if (description === '') {
        description_error.innerHTML = 'Please enter a product description.';
        isValid = false;
      }
  
      if (heading === '') {
        heading_error.innerHTML = 'Please enter a product heading.';
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
    if (category === '') {
      category_error.innerHTML = 'Please select a product category.';
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


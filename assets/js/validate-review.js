function validateReview_Form(event) {
    var name = document.forms[0]["name"].value.trim();
    var email = document.forms[0]["email"].value.trim();
    var message = document.forms[0]["message"].value.trim();
    var name_error = document.getElementById("name_error");
    var email_error = document.getElementById("email_error");
    var message_error = document.getElementById("message_error");
    var isValid = true; // Flag to track overall form validity

    // Clear previous error messages
    name_error.innerHTML = '';
    email_error.innerHTML = '';
    message_error.innerHTML = '';

    // Validate service name
    if (name === '') {
      name_error.innerHTML = 'Please enter a client name.';
      isValid = false;
    }
    if (email === '') {
        email_error.innerHTML = 'Please enter an email.';
        isValid = false;
    } else if (!validateEmail(email)) {
        email_error.innerHTML = 'Please enter a valid email.';
        isValid = false;
    }

    // Validate message word count (20 to 30 words)
   
    var maxWords = 50;
    var messageWords = message.split(/\s+/).filter(function(word) {
      return word.length > 0;
    }).length;

    if ( messageWords > maxWords) {
      message_error.innerHTML = 'Please enter a message with ' + maxWords + ' words.';
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
  document.getElementById('myButton').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default behavior of the button click event
    // Your other code logic here
});

document.addEventListener('DOMContentLoaded', function() {
  // Add event listener for form submission
  const form = document.getElementById('change-info');
  form.addEventListener('submit', function(event) {
      if (!check(event)) {
          // Prevent form submission if validation fails
          event.preventDefault();
      }
  });

  // Function to check form fields before submission
  function check(event) {
      try {
          // Get elements by their respective IDs
          var email = document.getElementById('email-entry');
          var date = document.getElementById('date-entry');

          // Clear previous error messages
          clearErrorMessages();

          // Check conditions for each field
          if (email.querySelector('input').value.length === 0) {
              displayErrorMessage(email, 'Email cannot be empty');
              return false; // Return false to indicate validation failure
          }

          if (date.querySelector('input').value.length === 0) {
              displayErrorMessage(date, 'Date cannot be empty');
              return false; // Return false to indicate validation failure
          }

          // If all conditions pass, return true to allow form submission
          return true;

      } catch (error) {
          console.error(error); // Log the error to the console
          return false; // Return false to indicate validation failure
      }
  }

  // Function to display error messages
  function displayErrorMessage(element, message) {
      var errorElement = document.createElement('div');
      errorElement.className = 'error-message';
      errorElement.textContent = message;

      // Insert the error message after the corresponding input field
      element.parentNode.insertBefore(errorElement, element.nextSibling);
  }

  // Function to clear previous error messages
  function clearErrorMessages() {
      var errorMessages = document.querySelectorAll('.error-message');
      errorMessages.forEach(function(errorMessage) {
          errorMessage.parentNode.removeChild(errorMessage);
      });
  }

  // Get the file input element
  const fileInput = document.getElementById('img');

  // Get the span element to display the file name
  const fileNameSpan = document.getElementById('file-name');

  // Add event listener to file input to update file name when a file is chosen
  fileInput.addEventListener('change', function() {
    
          // Display the chosen file name
          fileNameSpan.textContent = 'File chosen: ' + fileInput.files[0].name;
      
  });
});

function check(event) {
    try {
      // Get elements by their respective IDs
      var email = document.getElementById('email-entry');
      var phone = document.getElementById('phone-number-entry');
      var date = document.getElementById('date-entry');
  
      // Clear previous error messages
      clearErrorMessages();
  
      // Check conditions for each field
      if (email.querySelector('input').value.length===0) {
        displayErrorMessage(email, 'Email cannot be empty');
        event.preventDefault(); // Prevent form submission
        return false;
      }
  
      if (phone.querySelector('input').value.length ===0 || isNaN(phone.querySelector('input').value)) {
        displayErrorMessage(phone, 'Please enter a valid phone number');
        event.preventDefault(); // Prevent form submission
        return false;
      }
  
      if (date.querySelector('input').value.length ===0) {
        displayErrorMessage(date, 'Date cannot be empty');
        event.preventDefault(); // Prevent form submission
        return false;
      }
  
      // If all conditions pass, return true to allow form submission
      return true;
  
    } catch (error) {
      console.error(error); // Log the error to the console
      event.preventDefault(); // Prevent form submission
      return false;
    }
  };
  


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
    errorMessages.forEach(function (errorMessage) {
        errorMessage.parentNode.removeChild(errorMessage);
    });
}




// Get the file input element
const fileInput = document.getElementById('img');

// Get the span element to display the file name
const fileNameSpan = document.getElementById('file-name');

// Add event listener to file input to update file name when a file is chosen
fileInput.addEventListener('change', function() {
    // Check if a file is selected
    if (fileInput.files.length > 0) {
        // Display the chosen file name
        fileNameSpan.textContent = 'File chosen: ' + fileInput.files[0].name;
    } else {
        // Reset the file name display if no file is selected
        fileNameSpan.textContent = '';
    }
});


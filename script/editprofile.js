document.addEventListener('DOMContentLoaded', function() {
// Function to check if each field in the form has been entered
function check(event) {
    try {
        // Get input elements by their respective IDs
        var usernameInput = document.getElementById('username');
        var emailInput = document.getElementsByName('email')[0];
        var dobInput = document.getElementsByName('dob')[0];
        var bioInput = document.getElementsByName('bio')[0];

        // Clear previous error messages
        clearErrorMessages();

        // Check if any field is empty
        if (usernameInput.value.trim() === '') {
            displayErrorMessage(usernameInput, 'Username cannot be empty');
            return false; // Return false to indicate validation failure
        }

        if (emailInput.value.trim() === '') {
            displayErrorMessage(emailInput, 'Email cannot be empty');
            return false; // Return false to indicate validation failure
        }

        if (dobInput.value.trim() === '') {
            displayErrorMessage(dobInput, 'Date of Birth cannot be empty');
            return false; // Return false to indicate validation failure
        }

        if (bioInput.value.trim() === '') {
            displayErrorMessage(bioInput, 'Bio cannot be empty');
            return false; // Return false to indicate validation failure
        }

        // If all conditions pass, return true to allow form submission
        return true;

    } catch (error) {
        console.error(error); // Log the error to the console
        return false; // Return false to indicate validation failure
    }
}


// Add event listener to the form submission
document.getElementById("change-info").addEventListener("submit", function(event) {
    // Check form validity before submission
    if (!validateForm()) {
        event.preventDefault(); // Prevent form submission if validation fails
    }
});


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

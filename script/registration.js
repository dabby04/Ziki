document.addEventListener("DOMContentLoaded", () => {

    // Get today's date
    var today = new Date();

    // Calculate the date 18 years ago
    var maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());

    // Format the maxDate as yyyy-mm-dd for input element
    var formattedDate = maxDate.toISOString().split('T')[0];

    // Set the max attribute of the input element
    document.getElementById('dob').setAttribute('max', formattedDate);

    const form = document.getElementById("registration");
    if (form) {
        form.addEventListener("submit", function (e) {
            var name = document.getElementsByName("name")[0].value;
            var email = document.getElementsByName("email")[0].value;
            var dob = document.getElementsByName("dob")[0].value;
            var user = document.getElementsByName("username")[0].value;
            var pass = document.getElementsByName("password")[0].value;
            var repeat_pass = document.getElementsByName("repeat_pass")[0].value;

            if (name == null || name === "") {
                e.preventDefault();
                triggerHighlight("name");
                displayErrorMessage("Please enter a name", "name");
            } if (email == null || email === "") {
                e.preventDefault();
                triggerHighlight("email");
                displayErrorMessage("Please enter an email", "email");
            }
            if (dob == null || dob === "") {
                e.preventDefault();
                triggerHighlight("dob");
                displayErrorMessage("Please enter your date of birth", "dob");
            }
            if (user == null || user === "") {
                e.preventDefault();
                triggerHighlight("username");
                displayErrorMessage("Please enter a username", "username");
            } if (pass == null || pass === "") {
                e.preventDefault();
                triggerHighlight("password");
                displayErrorMessage("Please enter a password", "password");
            }
            if (repeat_pass == null || repeat_pass === "") {
                e.preventDefault();
                triggerHighlight("repeat_pass");
                displayErrorMessage("Repeat your password", "repeat_pass");
            }
            if (repeat_pass !== pass) {
                e.preventDefault();
                triggerHighlight("repeat_pass");
                triggerHighlight("password")
                displayErrorMessage("Passwords don't match", "repeat_pass");
            }
            else{
            validatePassword();
            }
            

        });
        var name = document.getElementsByName("name")[0];
        var email = document.getElementsByName("email")[0];
        var dob = document.getElementsByName("dob")[0];
        var user = document.getElementsByName("username")[0];
        var pass = document.getElementsByName("password")[0];
        var repeat_pass = document.getElementsByName("repeat_pass")[0];
        name.addEventListener('input', function () {
            removeHighlight("name");
            removeErrorMessage("name");
        })
        email.addEventListener('input', function () {
            removeHighlight("email");
            removeErrorMessage("email");
        })
        dob.addEventListener('input', function () {
            removeHighlight("dob");
            removeErrorMessage("dob");
        })
        user.addEventListener('input', function () {
            removeHighlight("username");
            removeErrorMessage("username");
        })
        pass.addEventListener('input', function () {
            removeHighlight("password");
            removeErrorMessage("password");
        })
        repeat_pass.addEventListener('input', function () {
            removeHighlight("repeat_pass");
            removeErrorMessage("repeat_pass");
        })

    };

    function triggerHighlight(name) {
        document.getElementsByName(name)[0].classList.add("empty");
    }
    function removeHighlight(name) {
        document.getElementsByName(name)[0].classList.remove("empty");
    }
    function displayErrorMessage(message, name) {
        var parentElement = document.getElementsByName(name)[0].parentNode;
        var existingErrorMessage = parentElement.querySelector(".error");
        if (!existingErrorMessage) {
            var errorMessage = document.createElement("div");
            errorMessage.textContent = message;
            errorMessage.classList.add("error");
            parentElement.appendChild(errorMessage);
        }
    }

    function removeErrorMessage(name) {
        var parentElement = document.getElementsByName(name)[0].parentNode;
        var errorMessage = parentElement.querySelector(".error");
        if (errorMessage) {
            parentElement.removeChild(errorMessage);
        }
    }

    function validatePassword() {
        let pass = document.getElementsByName("password")[0].value;
        let confirm_pass = document.getElementsByName("repeat_pass")[0].value;
    
        // if (pass !== confirm_pass && pass !== "" && confirm_pass !== "") {
        //     document.getElementById('wrong_pass_alert').style.color = 'red';
        //     document.getElementById('wrong_pass_alert').innerHTML = 'Passwords do not match';
        // } else {
            // Clear the message when passwords match
            document.getElementById('wrong_pass_alert').innerHTML = '';
        // }
    }
});

function displayErrorMessage(element, message) {

    var errorElement = document.createElement('div');
    errorElement.className = 'error-message';
    errorElement.textContent = message;

    // Insert the error message after the corresponding input field
    element.parentNode.insertBefore(errorElement, element.nextSibling);
}

// Function to clear previous error messages

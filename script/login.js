document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("form");
    if (form) {
        form.addEventListener("submit", function (e) {
            var user = document.getElementsByName("username")[0].value;
            var pass = document.getElementsByName("password")[0].value;

            if (user == null || user === "") {
                e.preventDefault();
                triggerHighlight("username");
                displayErrorMessage("Please enter a username", "username");
            } if (pass == null || pass === "") {
                e.preventDefault();
                triggerHighlight("password");
                displayErrorMessage("Please enter a password", "password");
            }
        });
        var user = document.getElementsByName("username")[0];
        var pass = document.getElementsByName("password")[0];
        user.addEventListener('input', function () {
            removeHighlight("username");
            removeErrorMessage("username");
        })
        pass.addEventListener('input', function () {
            removeHighlight("password");
            removeErrorMessage("password");
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
        var errorMessage = parentElement.querySelector(".error-message");
        if (errorMessage) {
            parentElement.removeChild(errorMessage);
        }
    }
});

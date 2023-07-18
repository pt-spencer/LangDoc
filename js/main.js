/** LOGIN AND SIGNUP */

document.addEventListener("DOMContentLoaded", function() {
  const loginForm = document.querySelector("#login");
  const signUpForm = document.querySelector("#SignUp");
  
  loginForm.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
      event.preventDefault();
    }
  });

  signUpForm.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
      event.preventDefault();
    }
  });



  document.querySelector("#linkSignUp").addEventListener("click", e => {
    e.preventDefault();
    loginForm.classList.add("form-hidden");
    signUpForm.classList.remove("form-hidden");
  });

  document.querySelector("#linkLogin").addEventListener("click", e => {
    e.preventDefault();
    loginForm.classList.remove("form-hidden");
    signUpForm.classList.add("form-hidden");
  });


  document.getElementById("user-email").addEventListener("input", validateEmail);
  document.getElementById("user-password").addEventListener("input", validatePassword);

});



function validatePassword() {
  var passwordInput = document.getElementById("user-password");
  var password = passwordInput.value;

  var requirements = [
	{ regex: /.{8,}/, message: "at least 8 characters long" },
    { regex: /[A-Z]/, message: "one uppercase letter" },
    { regex: /[a-z]/, message: "one lowercase letter" },
    { regex: /[0-9]/, message: "one numeric character" },
    { regex: /[!@#$%^&*(),.?":{}|<>_-]/, message: "one special character" },
    { regex: /[0-9]/, message: "one numeric character" }
  ];

  var errorMessage = document.querySelector('.sign-message-error');
  var errorMessages = [];

  if (password === "") {
    errorMessage.textContent = "";
    passwordInput.style.borderColor = "";
    return;
  }

  for (var i = 0; i < requirements.length; i++) {
    if (!requirements[i].regex.test(password)) {
      errorMessages.push(requirements[i].message);
    }
  }

  if (errorMessages.length > 0) {
    var errorMessageText = "Password must be ";
    if (errorMessages.length === 1) {
      errorMessageText += errorMessages[0] + ".";
    } else {
      var lastRequirement = errorMessages.pop();
      errorMessageText += errorMessages.join(", ") + ", and " + lastRequirement + ".";
    }
    errorMessage.textContent = errorMessageText;
    passwordInput.style.borderColor = "red";
  } else {
    errorMessage.textContent = "";
    passwordInput.style.borderColor = "";
  }
}


function validateEmail() {
  var emailInput = document.getElementById("user-email");
  var email = emailInput.value;

  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  var errorMessage = document.querySelector('.user-message-error');

  if (email === "") {
    errorMessage.textContent = "";
    emailInput.style.borderColor = "";
  } else if (!emailRegex.test(email)) {
    errorMessage.textContent = "Username must be a valid email address.";
    emailInput.style.borderColor = "red";
  } else {
    errorMessage.textContent = "";
    emailInput.style.borderColor = "";
  }
}


$(document).ready(function() {
  // Hide the signup button initially
  $('#signup-btn').hide();

  // Bind the logic to the input event of signupPassword
  $('#user-password').on('input', function() {
    var password = $(this).val().trim();
    var meetsRequirements = checkPasswordRequirements(password);

    if (meetsRequirements) {
      // Fade in the signup button
      $('#signup-btn').fadeIn(300);
    } else {
      // Otherwise, hide the signup button
      $('#signup-btn').fadeOut();
    }
  });


});

function checkPasswordRequirements(password) {
  var requirements = [
    { regex: /.{8,}/, message: "at least 8 characters long" },
    { regex: /[A-Z]/, message: "one uppercase letter" },
    { regex: /[a-z]/, message: "one lowercase letter" },
    { regex: /[0-9]/, message: "one numeric character" },
    { regex: /[!@#$%^&*(),.?":{}|<>_-]/, message: "one special character" }
  ];

  for (var i = 0; i < requirements.length; i++) {
    if (!requirements[i].regex.test(password)) {
      // Display the corresponding requirement message in #pass-error
      return false;
    }
  }

  // If all requirements are met, clear #pass-error
  $('#pass-error').text("");
  return true;
}


/** CREATE NEW PROJECT */

document.addEventListener("DOMContentLoaded", function() {
  const projectForm = document.querySelector("#project-info");
  
  projectForm.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
      event.preventDefault();
    }
  });

// Wait for the document to load
document.addEventListener("DOMContentLoaded", function() {
  // Get the input fields
  var projectNameInput = document.getElementById("project-name");
  var projectAffiliationInput = document.getElementById("project-affiliation");
  var projectLanguageInput = document.getElementById("project-language");

  // Add an event listener for form submission
  var projectForm = document.querySelector("#project-regis");
  projectForm.addEventListener("submit", function(event) {
    // Check if any of the fields are empty
    if (
      projectNameInput.value.trim() === "" ||
      projectAffiliationInput.value.trim() === "" ||
      projectLanguageInput.value.trim() === ""
    ) {
      // Prevent form submission
      event.preventDefault();

      // Display an error message
      alert("Please fill in all the required fields");
    }
  });
});
});

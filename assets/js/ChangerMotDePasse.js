var $password = $("#password");
var $confirmPassword = $("#confirm_password");
var $username = $("#username");

// Hide the tooltips
$("form span").hide();

// Return true if the username length is greater than 0
function isUsernamePresent() {
  return $username.val().length > 0;
}

// Return true if the password length is greater than 8
function isPasswordValid() {
  return $password.val().length > 8;
}

// Return true if the password matches the confirmation
function arePasswordsMatching() {
  return $password.val() === $confirmPassword.val();
}

// Return true if the password is valid and matches
function canSubmit() {
  return isPasswordValid() && arePasswordsMatching() && isUsernamePresent();
}

function passwordEvent() {
  // If the length of the value is greater than 8
  if (isPasswordValid()) {
    // Hide the tooltip
    $password.next().hide();
  } else {
    // Show the tooltip
    $password.next().show();
  }
}

function confirmPasswordEvent() {
  // If the password matches the confirmation input
  if (arePasswordsMatching()) {
    // Hide the tooltip
    $confirmPassword.next().hide();
  } else {
    // Show the tooltip
    $confirmPassword.next().show();
  }
}

// If canSubmit() is true then make submit disabled
function enableSubmitEvent() {
  $("#submit").prop("disabled", !canSubmit());
}

// When an event happens in the password input
$password.focus(passwordEvent).keyup(passwordEvent).keyup(confirmPasswordEvent).keyup(enableSubmitEvent);

// When an event happens in the confirmation input
$confirmPassword.focus(confirmPasswordEvent).keyup(confirmPasswordEvent).keyup(enableSubmitEvent);

enableSubmitEvent();
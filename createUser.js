function main(){
	var password = document.getElementById("password");
	var confirm_password = document.getElementById("confirm_password");

	password.onchange = validatePassword;
	confirm_password.onkeyup = validatePassword;

	document.getElementById("submit").addEventListener("click", function(event){
	  validatePassword();
	});
}

function validatePassword(){
  if(password.value != confirm_password.value) {
    document.getElementById("confirm_password").setCustomValidity("Passwords Don't Match");
    event.preventDefault()
  } else {
    confirm_password.setCustomValidity('');
  }
}

document.addEventListener("DOMContentLoaded", main);
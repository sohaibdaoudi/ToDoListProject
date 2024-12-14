const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const recoverLink = document.querySelector('#recoverLink a');
const signInForm = document.getElementById('signIn');
const signUpForm = document.getElementById('signup');
const recoverForm = document.getElementById('recover');

signUpButton.addEventListener('click', function () {
    signInForm.style.display = "none";
    recoverForm.style.display = "none";
    signUpForm.style.display = "block";
});

signInButton.addEventListener('click', function () {
    signUpForm.style.display = "none";
    recoverForm.style.display = "none";
    signInForm.style.display = "block";
});

recoverLink.addEventListener('click', function (event) {
    event.preventDefault();
    signInForm.style.display = "none";
    signUpForm.style.display = "none";
    recoverForm.style.display = "block";
});

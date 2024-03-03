const loginForm = document.getElementById("loginForm");
const registerForm = document.getElementById("registerForm");
const forgotPasswordForm = document.getElementById("forgotPasswordForm");
const showRegisterLink = document.getElementById("showRegisterForm");
const showLoginLink = document.getElementById("showLoginForm");
const showForgotPasswordLink = document.getElementById("showForgotPasswordForm");
const returnToLoginLink = document.getElementById("returnToLoginForm");

showRegisterLink.addEventListener("click", function (e) {
    e.preventDefault();
    loginForm.classList.remove("active");
    registerForm.classList.add("active");
    forgotPasswordForm.classList.remove("active");
});

showLoginLink.addEventListener("click", function (e) {
    e.preventDefault();
    registerForm.classList.remove("active");
    loginForm.classList.add("active");
    forgotPasswordForm.classList.remove("active");
});

showForgotPasswordLink.addEventListener("click", function (e) {
    e.preventDefault();
    loginForm.classList.remove("active");
    registerForm.classList.remove("active");
    forgotPasswordForm.classList.add("active");
});

returnToLoginLink.addEventListener("click", function (e) {
    e.preventDefault();
    forgotPasswordForm.classList.remove("active");
    loginForm.classList.add("active");
});

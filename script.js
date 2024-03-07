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



const elementos = document.querySelectorAll('.elemento1, .elemento2, .elemento3, .elemento4');

elementos.forEach(elemento => {
    elemento.addEventListener('click', () => {
        // Si el elemento ya está activo, no hagas nada
        if (elemento.classList.contains('active')) {
            return;
        }

        // Remueve la clase 'active' de todos los elementos
        elementos.forEach(el => el.classList.remove('active'));
        // Agrega la clase 'active' solo al elemento clickeado
        elemento.classList.add('active');
    });
});

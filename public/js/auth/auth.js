import { urls } from "../ajax.js";

const loginForm = document.getElementById("login-form");
const registerForm = document.getElementById("register-form");
const loginSwitchButton = document.getElementById("login-switch");
const registerSwitchButton = document.getElementById("register-switch");
const loginFetchButton = document.getElementById("login");
const registerFetchButton = document.getElementById("register");

const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const tokenInput = document.getElementById("_csrf_token");
const firstNameInput = document.getElementById("first-name");
const secondNameInput = document.getElementById("second-name");
const descriptionNameInput = document.getElementById("description");
const emailToRegisterInput = document.getElementById("email-to-register");
const passwordToRegisterInput = document.getElementById("password-to-register");
const hiddenClass = "hidden";

async function loginFetch(e) {
    e.preventDefault();

    const jsonData = {
        email: emailInput.value,
        password: passwordInput.value,
        _csrf_token: tokenInput.value,
    }

    const postData = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(jsonData),
    }

    const response = await fetch(urls.loginUser(), postData);
    if (response.ok) {
        location.replace('/');
    }
}

function registerFetch(e) {
    e.preventDefault();

    const jsonData = {
        firstName: firstNameInput.value,
        secondName: secondNameInput.value,
        description: descriptionNameInput.value,
        email: emailToRegisterInput.value,
        password: passwordToRegisterInput.value,
    }

    const postData = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(jsonData, null, 2),
    }

    fetch(urls.registerUser(), postData);
}

function switchOnRegister(e) {
    e.preventDefault();
    registerForm.classList.remove(hiddenClass);
    loginForm.classList.add(hiddenClass);
}

function switchOnLogin(e) {
    e.preventDefault();
    loginForm.classList.remove(hiddenClass);
    registerForm.classList.add(hiddenClass);
}

function initEventListeners() {
    loginSwitchButton.addEventListener("click", switchOnRegister);
    registerSwitchButton.addEventListener("click", switchOnLogin);
    loginFetchButton.addEventListener("click", loginFetch);
    registerFetchButton.addEventListener("click", registerFetch);
}

initEventListeners();
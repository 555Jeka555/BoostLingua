import { ajax } from "../ajax";

const loginForm = document.getElementById("login-form");

const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const tokenInput = document.getElementById("token");

function loginFetch() {
    const jsonData = {
        email: emailInput.value,
        password: passwordInput.value,
        _csrf_token: tokenInput.value,
    }

    const postData = {
        
    }

    fetch(ajax.loginUser(), postData)
}

function switchOnRegister() {

}

function switchOnLogin() {

}

function initEventListeners() {

}
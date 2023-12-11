import {urls} from "../ajax.js";

const trashButtons = document.querySelectorAll(".trash");

async function deletePost(e) {
    e.preventDefault();
    const target = e.target;
    const postData = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({}),
    }

    const response = await fetch(urls.deletePost(target.id), postData);
    if (response.ok) {
        location.reload();
    }
}

function initEventListeners() {
    trashButtons.forEach((button) => button.addEventListener("click", deletePost))
}

initEventListeners();
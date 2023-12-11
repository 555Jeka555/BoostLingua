import { urls } from "../ajax.js";

const createPostButton = document.getElementById("create-post");

const authorIdInput = document.getElementById("authorId");
const titleInput = document.getElementById("title");
const bodyInput = document.getElementById("body");

async function createPostFetch(e) {
    e.preventDefault();

    const jsonData = {
        authorId: authorIdInput.value,
        title: titleInput.value,
        body: bodyInput.value,
    }

    const postData = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(jsonData),
    }

    const response = await fetch(urls.createPost(), postData);
    if (response.ok) {
        location.replace('/');
    }
}

function initEventListeners() {
    createPostButton.addEventListener("click", createPostFetch);
}

initEventListeners();
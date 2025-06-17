

window.addEventListener('DOMContentLoaded', () => {
    const person = prompt("Welcome! Please enter your name:", "default");

    if (person !== null && person.trim() !== "") {
        const welcomeh1 = document.querySelector('.main-title');
        welcomeh1.innerHTML = `Welcome to FitManage, <strong>${person}</strong>!`;
    }
});

/* for email */
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const data = new FormData(form);

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();

    if (!name || !email) {
        alert("Please fill in all fields.");
        return;
    }

    fetch("https://formsubmit.co/5a8e06aa5ea4d46854ddd80c59f45325", {
        method: "POST",
        body: data,
    })
    .then(response => {
        if (response.ok) {
            alert(`Thank you, ${name}! We will contact you at ${email}.`);
            form.reset();
        } else {
            alert("Error sending the form");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An unexpected error occurred while submitting the form.");
    });
});



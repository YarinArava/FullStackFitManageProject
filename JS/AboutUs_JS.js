

let darkMode = false;
let leaderHighlighted = false;

function toggleTheme() {
    const body = document.body;
    const cards = document.querySelectorAll(".member-card");
    const contact = document.querySelector(".contact-section");

    darkMode = !darkMode;

    if (darkMode) {
        body.style.backgroundColor = "#2c3e50";
        body.style.color = "#ecf0f1";
        cards.forEach(card => {
            card.style.backgroundColor = "#34495e";
            card.style.color = "#ecf0f1";
        });
        contact.style.backgroundColor = "#3e5870";
    } else {
        body.style.backgroundColor = "#f2f2f2";
        body.style.color = "black";
        cards.forEach(card => {
            card.style.backgroundColor = "white";
            card.style.color = "black";
        });
        contact.style.backgroundColor = "#ecf0f1";
    }
}

function highlightLeader() {
    const leaderCard = document.getElementById("team-leader");
    leaderHighlighted = !leaderHighlighted;
    leaderCard.classList.toggle("leader-highlight", leaderHighlighted);
}

function submitForm() {
    const name = document.getElementById("name").value;
    alert("Thank you, " + name + "! Your message has been sent.");
    return false; // prevents actual form submission
}
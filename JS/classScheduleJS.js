const currentUser = "Amit_Romem"; // mock current user

// Store registered cells by user
const registeredCells = new Map();

function register(className) {
    const btn = event.target;
    const cell = btn.closest("td");
    const cellKey = generateCellKey(cell);
    const span = cell.querySelector(`span[data-counter='${className}']`);

    if (!registeredCells.has(currentUser)) {
        registeredCells.set(currentUser, new Set());
    }

    const userSet = registeredCells.get(currentUser);

    if (userSet.has(cellKey)) {
        // Unregister
        userSet.delete(cellKey);
        updateCounter(span, -1);
        btn.textContent = "Register";
    } else {
        // Register
        if (getCurrentCount(span) < 11) {
            userSet.add(cellKey);
            updateCounter(span, +1);
            btn.textContent = "Unregister";
        } else {
            alert("This class is full!");
        }
    }
}

function generateCellKey(cell) {
    const row = cell.parentElement;
    const time = row.children[0].textContent.trim();
    const dayIndex = [...row.children].indexOf(cell);
    return `${dayIndex}-${time}`;
}

function getCurrentCount(span) {
    return parseInt(span.textContent.split("/")[0]);
}

function updateCounter(span, delta) {
    let [count, max] = span.textContent.split("/");
    count = parseInt(count.trim()) + delta;
    span.textContent = `${count}/11 participants`;
}

function showToday() {
    const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const today = new Date().getDay();
    const dayName = days[today];
    const rows = document.querySelectorAll("table tbody tr");

    let result = `<h3>Today's Classes (${dayName}):</h3><ul>`;
    for (let row of rows) {
        const time = row.children[0].textContent;
        const cell = row.children[today + 1];
        if (!cell) continue;
        const fullText = cell.textContent;
        const classNameOnly = fullText.split("-")[0].trim();
        result += `<li>${time} - ${classNameOnly}</li>`;
    }
    result += "</ul>";
    document.getElementById("todayResult").innerHTML = result;
}
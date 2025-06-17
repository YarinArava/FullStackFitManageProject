
/* Register_JS */
function handleRegister() {
    const name = document.getElementById("fullName").value;
    const email = document.getElementById("email").value;
    const role = document.getElementById("role").value;

    if (name && email && role) {
        alert(`Welcome, ${name}! You registered as a ${role}.`);
        return false; // prevent actual form submission (demo only)
    } else {
        alert("Please fill in all required fields.");
        return false;
    }
}

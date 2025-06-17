// Approval of Pending users
function approvePendingUsers() {
    const rows = document.querySelectorAll("table tbody tr");
    rows.forEach(row => { /*using loop*/ 
        const statusCell = row.cells[3];
        if (statusCell.textContent.trim() === "Pending") {
            statusCell.textContent = "Active";
            statusCell.style.color = "green";
        }
    });
}

// Recent activity
function showSystemActivity() {
    const log = `
    * User Yarin updated schedule<br>
    * Admin approved 3 users<br>
    * Trainer Dan created new course
  `;
    const logArea = document.getElementById("logArea");
    logArea.innerHTML = "<h3>Activity Log:</h3>" + log;
    logArea.style.display = "block";
}

// Export to CSV
function exportTableToCSV() {
    let csv = 'ID,Name,Role,Status\n';
    const rows = document.querySelectorAll("table tbody tr");
    rows.forEach(row => { /* using loop */
        const cols = Array.from(row.querySelectorAll("td")) /*using array*/
            .slice(0, 4)
            .map(td => td.textContent.trim());
        csv += cols.join(",") + "\n";
    });

    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = "user_report.csv";
    a.click();
}

// Reset the filter of table
function resetTable() {
    const rows = document.querySelectorAll("table tbody tr");
    rows.forEach(row => {
        row.style.display = "";
    });
    document.getElementById("roleFilter").value = "";
}

// Filter by Role
function filterByRole() {
    const role = document.getElementById("roleFilter").value.toLowerCase();
    const rows = document.querySelectorAll("table tbody tr");

    rows.forEach(row => {
        const roleCell = row.cells[2].textContent.toLowerCase();
        row.style.display = (!role || roleCell === role) ? "" : "none";
    });
}

// User Delete
function deleteRow(button) {
    if (confirm("Are you sure you want to delete this user?")) {
        const row = button.parentElement.parentElement;
        row.remove();
        alert("User deleted.");
    }
}
 
﻿// Approval of Pending users
function approvePendingUsers() {
    const rows = document.querySelectorAll("table tbody tr");
    rows.forEach(row => { /*using loop*/ 
        const statusCell = row.cells[3];
        if (statusCell.textContent.trim() === "Pending") {
            statusCell.textContent = "Active";
            statusCell.style.color = "green";
        }
    });
}

// Recent activity
function showSystemActivity() {
    const log = `
    * User Yarin updated schedule<br>
    * Admin approved 3 users<br>
    * Trainer Dan created new course
  `;
    const logArea = document.getElementById("logArea");
    logArea.innerHTML = "<h3>Activity Log:</h3>" + log;
    logArea.style.display = "block";
}

// Export to CSV
function exportTableToCSV() {
    let csv = 'ID,Name,Role,Status\n';
    const rows = document.querySelectorAll("table tbody tr");
    rows.forEach(row => { /* using loop */
        const cols = Array.from(row.querySelectorAll("td")) /*using array*/
            .slice(0, 4)
            .map(td => td.textContent.trim());
        csv += cols.join(",") + "\n";
    });

    const blob = new Blob([csv], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.href = url;
    a.download = "user_report.csv";
    a.click();
}

// Reset the filter of table
function resetTable() {
    const rows = document.querySelectorAll("table tbody tr");
    rows.forEach(row => {
        row.style.display = "";
    });
    document.getElementById("roleFilter").value = "";
}

// Filter by Role
function filterByRole() {
    const role = document.getElementById("roleFilter").value.toLowerCase();
    const rows = document.querySelectorAll("table tbody tr");

    rows.forEach(row => {
        const roleCell = row.cells[2].textContent.toLowerCase();
        row.style.display = (!role || roleCell === role) ? "" : "none";
    });
}

// User Delete
function deleteRow(button) {
    if (confirm("Are you sure you want to delete this user?")) {
        const row = button.parentElement.parentElement;
        row.remove();
        alert("User deleted.");
    }
}
 

<?php
$servername = "sql207.byethost18.com";
$username = "b18_39117809";
$password = "4pk63byd";
$database = "b18_39117809_fitmanage_db";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

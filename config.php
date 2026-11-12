<?php
// Edit the password on the server after cloning (do not commit the real one)
$conn = new mysqli("localhost", "cat2user", "CHANGE_ME", "CAT2");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
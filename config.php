<?php
$conn = new mysqli("localhost", "danick", "CHANGE_ME", "CAT2");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
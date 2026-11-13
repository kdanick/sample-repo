<?php
require "config.php";

if (!isset($conn) || !($conn instanceof mysqli)) {
    $conn = new mysqli("localhost", "root", "", "sample_repo");
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
}

$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $fullname = trim($_POST["fullname"]);
    $email    = trim($_POST["email"]);
    $hash     = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, fullname, email, password) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $username, $fullname, $email, $hash);
    if ($stmt->execute()) {
        $msg = "Account created. <a href='login.php'>Log in</a>";
    } else {
        $msg = "Error: " . htmlspecialchars($stmt->error);
    }
}
?>
<!DOCTYPE html>
<html><head><title>Sign up - version 2</title><link rel="stylesheet" href="style.css"></head>
<body><div class="box">
<h2>Sign up - version 2</h2>
<form method="POST">
  Username <input type="text" name="username" required>
  Full name <input type="text" name="fullname" required>
  Email <input type="email" name="email" required>
  Password <input type="password" name="password" required>
  <button type="submit">Create account</button>
</form>
<p class="msg"><?php echo $msg; ?></p>
<a href="index.php">Home</a>
</div></body></html>
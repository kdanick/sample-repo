<?php
session_start();
require "config.php";
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("SELECT fullname, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $_POST["username"]);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($_POST["password"], $user["password"])) {
        $_SESSION["user"] = $_POST["username"];
        $_SESSION["fullname"] = $user["fullname"];
        header("Location: dashboard.php");
        exit;
    }
    $msg = "Invalid username or password";
}
?>
<!DOCTYPE html>
<html><head><title>Login</title><link rel="stylesheet" href="style.css"></head>
<body><div class="box">
<h2>Log in</h2>
<form method="POST">
  Username <input type="text" name="username" required>
  Password <input type="password" name="password" required>
  <button type="submit">Log in</button>
</form>
<p class="msg"><?php echo $msg; ?></p>
<a href="index.php">Home</a>
</div></body></html>
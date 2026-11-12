<?php
session_start();
if (!isset($_SESSION["user"])) { header("Location: login.php"); exit; }
?>
<!DOCTYPE html>
<html><head><title>Dashboard</title><link rel="stylesheet" href="style.css"></head>
<body><div class="box">
<h2>Welcome, <?php echo htmlspecialchars($_SESSION["fullname"]); ?></h2>
<p>You are logged in as <b><?php echo htmlspecialchars($_SESSION["user"]); ?></b>.</p>
<p><a href="feedback.php">Feedback form</a> | <a href="logout.php">Log out</a></p>
</div></body></html>
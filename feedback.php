<?php
require "config.php";
$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("INSERT INTO feedback (name, message) VALUES (?,?)");
    $stmt->bind_param("ss", $_POST["name"], $_POST["message"]);
    $msg = $stmt->execute() ? "Feedback saved." : "Error: " . htmlspecialchars($stmt->error);
}
$rows = $conn->query("SELECT id, name, message, created_at FROM feedback ORDER BY id DESC");
?>
<!DOCTYPE html>
<html><head><title>Feedback</title><link rel="stylesheet" href="style.css"></head>
<body><div class="box" style="max-width:640px">
<h2>Feedback</h2>
<form method="POST">
  Name <input type="text" name="name" required>
  Message <textarea name="message" rows="3" required></textarea>
  <button type="submit">Submit</button>
</form>
<p class="msg"><?php echo $msg; ?></p>
<table>
<tr><th>ID</th><th>Name</th><th>Message</th><th>Time</th></tr>
<?php while ($r = $rows->fetch_assoc()) { ?>
<tr>
  <td><?php echo $r["id"]; ?></td>
  <td><?php echo htmlspecialchars($r["name"]); ?></td>
  <td><?php echo htmlspecialchars($r["message"]); ?></td>
  <td><?php echo $r["created_at"]; ?></td>
</tr>
<?php } ?>
</table>
<p><a href="index.php">Home</a></p>
</div></body></html>
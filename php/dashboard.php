<?php
session_start();
require_once "db_config.php";

// Simple login using a fixed password (for lab demo only).
$loggedIn = $_SESSION["logged_in"] ?? false;
$flash = "";

if (isset($_POST["password"])) {
    if ($_POST["password"] === "admin123") {  // change this
        $_SESSION["logged_in"] = true;
        $loggedIn = true;
    } else {
        $flash = "Wrong password";
    }
}

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Messages</title>
  <style>
    body { font-family: Arial, sans-serif; background:#0f172a; color:#e5e7eb; }
    table { border-collapse:collapse; width:100%; margin-top:1rem; }
    th,td { border:1px solid #1f2937; padding:8px; }
    th { background:#020617; }
    .container { max-width:1000px; margin:2rem auto; }
    a { color:#38bdf8; }
  </style>
</head>
<body>
<div class="container">
<?php if (!$loggedIn): ?>
  <h2>Dashboard Login</h2>
  <?php if ($flash) echo "<p>$flash</p>"; ?>
  <form method="post">
    <label>Password:
      <input type="password" name="password" required />
    </label>
    <button type="submit">Login</button>
  </form>
<?php else: ?>
  <h2>Contact Messages</h2>
  <p><a href="?logout=1">Logout</a></p>
  <?php
    $result = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
    if ($result && $result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>USN</th><th>Email</th><th>Subject</th><th>Message</th><th>Created At</th></tr>";
        while ($row = $result->fetch_assoc()) {  // associative array
            echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["name"]."</td>";
            echo "<td>".$row["usn"]."</td>";
            echo "<td>".$row["email"]."</td>";
            echo "<td>".$row["subject"]."</td>";
            echo "<td>".$row["message"]."</td>";
            echo "<td>".$row["created_at"]."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No messages yet.</p>";
    }
  ?>
<?php endif; ?>
</div>
</body>
</html>
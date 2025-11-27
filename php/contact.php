<?php
session_start();
require_once "db_config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = trim($_POST["name"] ?? "");
    $usn     = trim($_POST["usn"] ?? "");
    $email   = trim($_POST["email"] ?? "");
    $subject = trim($_POST["subject"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name && $usn && $email && $subject && $message) {
        $stmt = $conn->prepare(
            "INSERT INTO contact_messages (name, usn, email, subject, message)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $name, $usn, $email, $subject, $message);

        if ($stmt->execute()) {
            // Cookie + session example
            setcookie("last_visitor", $name, time() + 86400 * 7, "/");
            $_SESSION["flash_message"] = "Thank you! Your message has been saved.";
        } else {
            $_SESSION["flash_message"] = "Database error: " . $conn->error;
        }

        $stmt->close();
    } else {
        $_SESSION["flash_message"] = "All fields are required.";
    }
}

header("Location: ../index.html#contact");
exit;
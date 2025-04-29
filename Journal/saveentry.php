<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

require_once 'db.php'; // Include your database connection file

// Get form data
$title = $_POST['title'];
$content = $_POST['content'];
$username = $_SESSION['username'];

// Insert the journal entry into the database
$query = "INSERT INTO journal_entries (username, title, content, created_at) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($query);
$stmt->bind_param('sss', $username, $title, $content);

if ($stmt->execute()) {
    echo "Success";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

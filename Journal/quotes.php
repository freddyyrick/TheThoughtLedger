<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$database = "journal_system";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    echo json_encode(["quote_text" => "Database connection failed.", "quote_author" => "System"]);
    exit;
}

$sql = "SELECT quote, author FROM quotes ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $quote = $result->fetch_assoc();
    echo json_encode([
        "quote_text" => $quote['quote'],
        "quote_author" => $quote['author']
    ]);
} else {
    echo json_encode(["quote_text" => "No quotes found.", "quote_author" => "System"]);
}

$conn->close();
?>

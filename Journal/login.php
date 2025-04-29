<?php
include "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Prepare the query to select the user by username very korique right???!! RIGHT??!!!
  $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result(); // Fetch result set

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();  // Fetch user data

    // Verify password
    if (password_verify($password, $row['password'])) {
      // Save user info in session
      $_SESSION['username'] = $row['username'];

      // paadto sa dashboard
      header("Location: dashboard.php");
      exit();
    } else {
      echo "Incorrect password.";
    }
  } else {
    echo "No account found with that username.";
  }

  $stmt->close();
  $conn->close();
}
?>

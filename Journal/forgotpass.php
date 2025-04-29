<?php
include "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Trim input to remove accidental spaces
  $firstname = trim($_POST['first_name']);
  $lastname = trim($_POST['last_name']);
  $email = trim($_POST['email']);
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  // Check if passwords match
  if ($new_password !== $confirm_password) {
    echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
    exit();
  }

  // Check password strength (at least 6 characters)
  if (strlen($new_password) < 6) {
    echo "<script>alert('Password must be at least 6 characters long.'); window.history.back();</script>";
    exit();
  }

  // Check if the user exists
  $stmt = $conn->prepare("SELECT id FROM users WHERE first_name = ? AND last_name = ? AND email = ?");
  $stmt->bind_param("sss", $firstname, $lastname, $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // User found, hash and update password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update = $conn->prepare("UPDATE users SET password = ? WHERE first_name = ? AND last_name = ? AND email = ?");
    $update->bind_param("ssss", $hashed_password, $firstname, $lastname, $email);
    $update->execute();

    // Confirm the update was successful
    if ($update->affected_rows > 0) {
      // Redirect to reset success page
      header("Location: resetsuccess.html");
      exit();
    } else {
      echo "<script>alert('Something went wrong. Please try again.'); window.history.back();</script>";
    }

    $update->close();
  } else {
    echo "<script>alert('User not found. Please check your information.'); window.history.back();</script>";
  }

  $stmt->close();
  $conn->close();
}
?>

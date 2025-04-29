  <?php
include "db.php";  // db connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];  
  $firstname = $_POST['first_name'];
  $lastname = $_POST['last_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm = $_POST['confirm_password'];

  // Check if passwords match
  if ($password !== $confirm) {
    echo "Passwords do not match.";
    exit();
  }

  // hash password for security very korique
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Insert into DB
  $stmt = $conn->prepare("INSERT INTO users (username, first_name, last_name, email, password) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $username, $firstname, $lastname, $email, $hashed_password);

  if ($stmt->execute()) {
    header("Location: signupsuccess.html");
    exit();
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  $conn->close();
}
?>




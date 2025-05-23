<?php
$host = 'localhost';
$db   = 'wedding';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (!empty($_POST['name']) && !empty($_POST['message'])) {
  $stmt = $conn->prepare("INSERT INTO wish (name, message) VALUES (?, ?)");
  $stmt->bind_param("ss", $name, $message);

  $name = $_POST['name'];
  $message = $_POST['message'];

  if ($stmt->execute()) {
    header("Location: thankyou.html");
    exit();
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
} else {
  echo "Please fill in all fields.";
}

$conn->close();
?>

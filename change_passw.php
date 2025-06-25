<html>
  <head>
    <title>Insecure Login - Change Password</title>
    <link rel='stylesheet' href='/style.css'>
  </head>
  <body>
<?php
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $connection = getConnection();
  $username = $_POST['username'];
  $oldPassword = $_POST['oldPassword'];
  $newPassword = $_POST['newPassword'];

  if ($oldPassword == '' || $newPassword == '') {
    echo "Invalid input.</body></html>";
    die();
  }

  $query = "SELECT password FROM users WHERE username = ?";
  $stmt = $connection->prepare($query);

  $stmt->bind_param('s', $username);
  $stmt->execute();
  $dbPassword = $stmt->get_result()->fetch_assoc()['password'];
  
  if (!password_verify($oldPassword, $dbPassword)) {
    echo "Wrong password.</body></html>";
    die();
  }
  
  $updateQuery = "UPDATE users SET password = '" . password_hash($newPassword, PASSWORD_DEFAULT) . "' WHERE username = '$username'";
  $connection->query($updateQuery);
  $stmt->close();
  $connection->close();
}
?>

    Password changed successfully!
  </body>
</html>

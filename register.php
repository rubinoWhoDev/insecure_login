<html>
  <head>
    <title>Insecure Login - Register</title>
    <link rel='stylesheet' href='/style.css'>
  </head>
  <body>
<?php
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $connection = getConnection();
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username == '' || $password == '') {
    echo "Invalid username or password.";
    die();
  }  

  $password = password_hash($password, PASSWORD_DEFAULT);
  $query = "INSERT INTO users (username, password) VALUES (?, ?)";
  $stmt = $connection->prepare($query);

  $stmt->bind_param('ss', $username, $password);
  $stmt->execute();
  $stmt->close();
  $connection->close();
  echo "User registered successfully. <a href='/login.html'>Login</a></body></html>";
  die();
}
?>
    <h1>Secure register? Maybe...</h1>
    <form action='<?=$_SERVER['PHP_SELF']?>' method='POST'>
      <label>Username</label>
      <input type='text' name='username' placeholder='Enter your username...'/><br><br>
      <label>Password</label>
      <input type='password' name='password' placeholder='Enter your password...'/><br><br>
      <input type='submit' value='Register'/>
    </form>
    Already registered?
    <a href='/login.html'>Login</a>
  </body>
</html>

<html>
  <head>
    <title>Insecure Login - User Page</title>
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

  $query = "SELECT password FROM users WHERE username = ?";
  $stmt = $connection->prepare($query);

  $stmt->bind_param('s', $username);
  $stmt->execute();
  $dbPassword = $stmt->get_result()->fetch_assoc()['password'];
  
  if (!password_verify($password, $dbPassword)) {
    echo "Wrong username or password. <a href='/login.html'>Try again</a></body></html>";
    die();
  }
  $stmt->close();
  $connection->close();
}    
?>
    <h1>Hello, <?=$username?></h1>
    Welcome to your userpage!
    <h2>Change Password</h2>
    <form action='/change_passw.php' method='POST'>
      <label>Old Password</label>
      <input type='password' name='oldPassword' placeholder='Enter your old password...'/><br><br>
      <label>New Password</label>
      <input type='password' name='newPassword' placeholder='Enter your new password...'/><br><br>
      <input type='hidden' name='username' value='<?=htmlspecialchars($username, ENT_QUOTES)?>'/>
      <input type='submit' value='Change'/>
    </form>
  </body>
</html>

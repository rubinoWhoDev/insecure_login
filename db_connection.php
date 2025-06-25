<?php
// dati fittizi
function getConnection() : mysqli {
  $db = "i_login";
  $host = "localhost";
  $user = "username";
  $password = "password";
  $connection = new mysqli($host, $user, $password, $db);
  return $connection;
}


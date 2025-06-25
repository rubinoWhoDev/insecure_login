<?php

function getConnection() : mysqli {
  $db = "i_login";
  $host = "localhost";
  $user = "rubino";
  $password = "password";
  $connection = new mysqli($host, $user, $password, $db);
  return $connection;
}


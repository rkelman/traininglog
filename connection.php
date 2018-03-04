<?php

function connectDB() {

  $servername = "localhost";
  $user = "daxhundc_misc";
  $passwd = "d4x-Tr41n1ng";
  $dbname = "daxhundc_misc";

  $dh_conn = new mysqli($servername, $user, $passwd, $dbname);

  if ($dh_conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  } else {
    return $dh_conn;
  }
?>

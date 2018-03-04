<?php

function connectDB() {

  $servername = "localhost";
  $user = "daxhundc_misc";
  $passwd = "m1sc-D4x";
  $dbname = "daxhundc_misc";

  $dh_conn = new mysqli($servername, $user, $passwd, $dbname);

  if ($dh_conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  } else {
    return $dh_conn;
  }
?>

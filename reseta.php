<?php
include 'connection.php';
include 'userkey.php';

$conn = connectDB();

if (!isset($_POST["email"]) && !isset($_GET["email"])) {
  echo "<html>\n";
  echo "<head>\n<link rel=\"stylesheet\" href=\"traininglog.css\">\n";
  echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
  echo "</head>\n";
  echo "<body>\n";
  if (isset($_GET["err"])) {
    echo "<neg_mesg>Sorry, The email you entered is not registered to a Traininglog user.</neg_mesg><BR>";
  }
  echo "Please enter e-mail to reset password<BR><BR>";
  echo "<form action=\"reseta.php\" method=\"post\">\n";
  echo "eMail: ";
  echo "<input type=\"text\" name=\"email\"><BR>\n";
  echo "<input type=\"submit\" name=\"Request Reset\"><BR>\n";
  echo "</form>\n";
  echo "</body>\n";
  echo "</html>";
}  elseif (isset($_POST["email"])) {
  $username = $_POST["email"];
  //echo $username."<BR>\n";
  $res_sql = "SELECT * from tlUsers where email = '".$username."'";
  //echo $res_sql;

  if (!$res_result = $conn->query($res_sql)) {
    // Oh no! The query failed.
    echo "<neg_mesg>Sorry, Traininglog is experiencing problems.</neg_mesg><BR>";
    echo $res_sql;
  }

  if ($res_result->num_rows > 0) {
    $key = createUserKey($username);
    //echo $key;
    mailUserKey($username, $key);

    echo "<html>\n";
    echo "<head>\n<link rel=\"stylesheet\" href=\"traininglog.css\">\n";
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
    echo "</head>\n";
    echo "<body>\n";
    echo "A link to reset your password has been sent to your email<BR><BR>";
    echo "Please check your email to complete the reset process<BR>\n";
    echo "</body>\n";
    echo "</html>";
 } else {
   header('Location: reseta.php?err=InvalidName')
 }
//if somehow they got to this page without entering their email send them back
}

$conn->close()

?>

<?php
include 'connection.php';
include 'userkey.php';

$conn = connectDB();

//if password is being sent and we are on the last step
if (isset($_POST["password"])) {
  $username = $_POST["email"];
  $key = $_POST["key"];
  $passwd = $_POST["password"];
  $passwd2 = $_POST["password_conf"];
// check values and insert into db


//if the user has received the key in email
} elseif (isset($_GET["key"])) {
  $username = $_GET["name"];
  $key = $_GET["key"];

  if (validateUserKey($username, $key)) {
    echo "<html>\n";
    echo "<head>\n<link rel=\"stylesheet\" href=\"traininglog.css\">\n";
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
    echo "</head>\n";
    echo "<body>\n";
    echo "<form action=\"reset.php\" method=\"post\">\n";
    echo "New Password: ";
    echo "<input type=\"passord\" name=\"password\"><BR>\n";
    echo "Confirm Password: ";
    echo "<input type=\"passord\" name=\"password\"><BR>\n";
    echo "<input type=\"submit\" name=\"Reset Password\"><BR>\n";
    echo "</form>\n";
    echo "</body>\n";
    echo "</html>";
  } else {
    //else if key is invalid - give user error and link to start over
    echo "<html>\n";
    echo "<head>\n<link rel=\"stylesheet\" href=\"traininglog.css\">\n";
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
    echo "</head>\n";
    echo "<body>\n";
    echo "<neg_mesg>We're sorry your key is has either expired or is invalid</neg_mesage>\n";
    echo "<a href=\"reset.php\">Please request a new key to reset your password</href>\n";
    echo "</body>\n";
    echo "</html>";
  }

//if the user has simply requested the reset
} elsif (isset($_POST["email"])) {
  $username = $_POST["email"];

  $key = createUserKey($username);
  emailUserKey($key, $username);

  echo "<html>\n";
  echo "<head>\n<link rel=\"stylesheet\" href=\"traininglog.css\">\n";
  echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
  echo "</head>\n";
  echo "<body>\n";
  echo "A link to reset your password has been sent to your email<BR><BR>";
  echo "Please check your email to complete the reset process<BR>\n";
  echo "</body>\n";
  echo "</html>";

//if we're on the first step - no email has been requested
} else {

  echo "<html>\n";
  echo "<head>\n<link rel=\"stylesheet\" href=\"traininglog.css\">\n";
  echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
  echo "</head>\n";
  echo "<body>\n";
  echo "Please enter e-mail to reset password<BR><BR>";
  echo "<form action=\"reset.php\" method=\"post\">\n";
  echo "eMail: ";
  echo "<input type=\"text\" name=\"email\"><BR>\n";
  echo "<input type=\"submit\" name=\"Request Reset\"><BR>\n";
  echo "</form>\n";
  echo "</body>\n";
  echo "</html>";

}

$conn->close();

}
?>

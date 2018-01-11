<?php
include 'connection.php';

if (isset($_POST["username"])) {
  $username = $_POST["username"];
  $passwd = $_POST["password"];
  echo $username;
  echo " ".$passwd;

  $conn = connectDB();

  $log_sql = "SELECT email, password, ID
    FROM tlUsers
    WHERE email = '".$username."'";

  echo $log_sql;

  if (!$log_result = $conn->query($log_sql)) {
    // Oh no! The query failed.
    $errString = "<neg_mesg>Sorry, Traininglog is experiencing problems.</neg_mesg><BR>";
    echo $log_sql;
  } elseif ($log_result->num_rows == 0) {
    $errString = "<neg_mesg>Sorry, that username was not found.</neg_mesg><BR>";
  } else {
    $row = $log_result->fetch_assoc();
    if ($passwd == $row['password']) {
    //if (hash('gost', $passwd)==$row['password']) {
      $cookie_value=$row['ID'];
      setcookie('uid', $cookie_value, time() + (5184000), "/"); // 5184000 = 60 days
      header("Location:index.php");
    } //elseif (hash('gost', $passwd)!=$row['password']) {
      elseif ($passwd != $row['password']) {
       $errString = "<neg_mesg>Sorry, that password was not valid.</neg_mesg><BR>";
    }
  }
}
echo "<html>\n";
echo "<head>\n<link rel=\"stylesheet\" href=\"traininglog.css\">\n";
echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
echo "</head>\n";
echo "<body>\n";
if (isset($errString)) {
  echo $errString;
}
echo "<form action=\"login.php\" method=\"post\">\n";
echo "Username: ";
echo "<input type=\"text\" name=\"username\"><BR>\n";
echo "Password: ";
echo "<input type=\"password\" name=\"password\"><BR>\n";
echo "<input type=\"submit\" name=\"Login\"><BR>\n";
echo "</form>\n";
echo "<a href=\"register.php\">Create Account</a> ";
echo " <a href=\"reset.php\">Forgot Password</a>";

$conn->close();

echo "</body>\n";
echo "</html>";

?>

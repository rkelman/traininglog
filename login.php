<?php
include 'connection.php';

if (isset($_POST["username"])) {
  $username = $_POST["username"];
  $passwd = $_POST["password"];

  $conn = connectDB();

  $log_sql = "SELECT email, password, ID
    FROM tlUsers
    WHERE email = '".$user."'";

    if (!$log_result = $conn->query($log_sql)) {
      // Oh no! The query failed.
      echo "<neg_mesg>Sorry, Traininglog is experiencing problems.</neg_mesg><BR>";
      echo $tot_sql;
    }
}

echo "<html>\n";
echo "<head>\n<link rel=\"stylesheet\" href=\"traininglog.css\">\n";
echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
echo "</head>\n";
echo "<body>\n";
echo "<form action=\"login.php\" method=\"post\">\n";
echo "First Name: ";
echo "<input type=\"text\" name=\"first_name\"><BR>\n";
echo "Last Name: ";
echo "<input type=\"text\" name=\"last_name\"><BR>\n";
echo "eMail: ";
echo "<input type=\"text\" name=\"username\"><BR>\n";
echo "Password: ";
echo "<input type=\"password\" name=\"password\"><BR>\n";
echo "Confirm Password: ";
echo "<input type=\"password\" name=\"password\"><BR>\n";
echo "</form>\n";

$conn->close();

echo "</body>\n";
echo "</html>";

?>

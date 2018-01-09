<?php
include 'connection.php';

if (isset($_POST["username"])) {
  $user = $_POST["username"];
  $passwd = $_POST["password"];

  $conn = connectDB();

  $log_sql = "SELECT email, password, ID
    FROM tlUsers
    WHERE email = '".$user."';

    $log_result = $conn->query($log_sql);

    if (!$log_result = $conn->query($tot_sql)) {
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
echo "Username: ";
echo "<input type=\"text\" name=\"username\"><BR>\n";
echo "Password";
echo "<input type=\"password\" name=\"password\"><BR>\n";
echo "</form>\n";
echo "<href>Create Account</href>"
?>

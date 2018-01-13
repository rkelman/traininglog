<?php
include 'connection.php';
include 'userkey.php';

$conn = connectDB();

if (isset($_POST["email"])) {
  $username = $_POST["email"];
  $res_sql = "SELECT * from tlUsers where email = '".$username."'";

  if (!$res_result = $conn->query($res_sql)) {
    // Oh no! The query failed.
    echo "<neg_mesg>Sorry, Traininglog is experiencing problems.</neg_mesg><BR>";
    echo $res_sql;
  }

  if ($res_result->num_rows > 0) {
    $key = createUserKey($username);
    echo $key;
    emailUserKey($username, $key);

    echo "<html>\n";
    echo "<head>\n<link rel=\"stylesheet\" href=\"traininglog.css\">\n";
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
    echo "</head>\n";
    echo "<body>\n";
    echo "A link to reset your password has been sent to your email<BR><BR>";
    echo "Please check your email to complete the reset process<BR>\n";
    echo "</body>\n";
    echo "</html>";
  }
//if somehow they got to this page without entering their email send them back
} else {
  header('Location: reseta.php');
}

$conn->close();

?>

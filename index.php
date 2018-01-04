<?php
include 'connection.php';

if (isset($_POST["sport"])) {
  $sport = $_POST["sport"];
  $dist = $_POST["distance"];
  $time = $_POST["time"];

  $conn = connectDB();

  if ($conn->connect_errno > 0) {
    die("Connection failed: " . $conn->connect_error);
  }

  $ins_sql = "INSERT into training_log
      (trainDate, distance, elapsedTime, type)
      VALUES
      (now(), ".$dist.", ".$time.", '".$sport."')";

  $ins_trainlog=$conn->query($ins_sql);

  $conn->close();

}
echo "<html>\n";
echo "<body>\n";
echo $ins_sql;
if ($ins_trainlog) {
  echo "Training Inserted Successfully\n";
}
echo "<form action=\"index.php\" method=\"post\">\n";
echo "Enter new training activity:<BR>\n";
echo "Distance (mi/yds): ";
echo "<input type=\"text\" name=\"distance\"><BR>\n";
echo "Elapsed Time (min): ";
echo "<input type=\"text\" name=\"time\"><BR>\n";
echo "Sport: ";
echo "<select name=\"sport\">\n";
echo "  <option value=\"Cycling\">Cycling</option>\n";
echo "  <option value=\"Run\">Running</option>\n";
echo "  <option value=\"Swim\">Swim</option>\n";
echo "  <option value=\"Circuit\">Circuit</option>\n";
echo "</select>\n";
echo "<input type=\"submit\" value=\"Log Training\">";
echo "</form>\n";
echo "</body>\n";
echo "</html>";
?>

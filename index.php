<?php
include 'connection.php';

$conn = connectDB();

if (isset($_POST["sport"])) {
  $sport = $_POST["sport"];
  $time = $_POST["time"];

  //if distance is not set (like for circuit) set it to 0
  if (isset($_POST["distance"])) {
    $dist = $_POST["distance"];
  } else {
    $dist = 0;
  }

  if ($conn->connect_errno > 0) {
    die("<neg_mesg>Connection failed: ".$conn->connect_error."</neg_mesg>");
  }

  $ins_sql = "INSERT into training_log
      (trainDate, distance, elapsedTime, type)
      VALUES
      (now(), ".$dist.", '".$time."', '".$sport."')";

  $ins_trainlog=$conn->query($ins_sql);

}
echo "<html>\n";
echo "<head>\n<link rel=\"stylesheet\" href=\"traininglog.css\">\n";
echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
echo "</head>\n";
echo "<body>\n";
//troubleshooting insert statements
//echo $ins_sql;
if ($ins_trainlog) {
  if ($sport == 'Cycling') {
    $activity = 'ride';
  } elseif ($sport == 'Running') {
    $activity = 'run';
  } else {
    $activity = strtolower($sport);
  }
  echo "<pos_mesg>New ".$activity." logged successfully</pos_mesg><BR><BR>\n";
}

echo "<form action=\"index.php\" method=\"post\">\n";
echo "Enter new training activity:<BR>\n";
echo "Distance (mi/yds): ";
echo "<input type=\"text\" name=\"distance\"><BR>\n";
echo "Elapsed Time (0:00:00): ";
echo "<input type=\"text\" name=\"time\"><BR>\n";
echo "Sport: ";
echo "<select name=\"sport\">\n";
echo "  <option value=\"Cycling\">Cycling</option>\n";
echo "  <option value=\"Run\">Running</option>\n";
echo "  <option value=\"Swim\">Swim</option>\n";
echo "  <option value=\"Circuit\">Circuit</option>\n";
echo "</select><BR>\n";
echo "<input type=\"submit\" value=\"Log Training\">";
echo "</form>\n";
echo "<BR><BR>";
echo "Annual Totals for ".date('M j').":<BR>\n";
$tot_sql = "SELECT type, sum(distance) sum_dist FROM training_log GROUP BY type";

$tot_result = $conn->query($tot_sql);

if (!$tot_result = $conn->query($tot_sql)) {
  // Oh no! The query failed.
  echo "<neg_mesg>Sorry, Traininglog is experiencing problems.</neg_mesg><BR>";
  echo $tot_sql;
}

if ($tot_result->num_rows > 0) {
  // output data of each row
  while($row = $tot_result->fetch_assoc()) {
    if ($row['type']=='Cycling') {
      $dist_unit = 'Miles';
      $target = 4000*(date('z')+1)/365;
    } elseif ($row['type']=='Running') {
      $dist_unit = 'Miles';
      $target = 370*(date('z')+1)/365;
    } else {
      $dist_unit = 'Yds';
    }
    echo $row['type'].": ".$row['sum_dist']." ".$dist_unit."; Target: ".$target." ".$dist_unit."<BR>\n";
  }
} else {
  echo "<neg_mesg>Sorry - no training logged this year</neg_mesg><BR>\n";
}

$conn->close();

echo "</body>\n";
echo "</html>";
?>

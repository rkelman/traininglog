<?php
include 'connection.php';
include 'userkey.php';

$conn = connectDB();

print_r($_POST);

//if no post or get; first time to page
if (isset($_POST['password']) && isset($_POST['password_conf'])) {
  //if passwords are both set/not null load variables
  $pass1 = $_POST['password'];
  $pass2 = $_POST['password_conf'];
  $mailID = $_POST['mail'];
  $keyID = $_POST['key'];
  echo "pass: ".$pass1."<BR>\n";
  echo "mail: ".$mailID."<BR>\n";
  if ($pass1 == $pass2) {
    //if passwords match
    $hashPass = getPassHash($pass1);
    $res_sql = "Update tlUsers SET password='".$hashPass."' ".
       "WHERE email ='".$mailID."'";
    if (!$res_result = $conn->query($res_sql)) {
      // Oh no! The query failed.
      echo "<neg_mesg>Sorry, Traininglog is experiencing problems.</neg_mesg><BR>";
      echo $tot_sql;
    } else {
      //if update worked
      echo "<html>\n";
      echo "<head>\n<link rel=\"stylesheet\" href=\"traininglog.css\">\n";
      echo "<meta name=\"\" content=\"width=device-width, initial-scale=1.0\">";
      echo "</head>\n";
      echo "<body>\n";
      echo "Your Password has been updated<BR>";
      echo "<a href=\"login.php\">Go to login</a><BR>";
  } else {
    //if passwords don't match return to reset
    header('Location: reset.php?mail='.$mailID.'&key='.$keyID.'&err=passMismatch');
  }
} else {
  //if either password was sent over null return to reset
  header('Location: reset.php?mail='.$_POST['mail'].'&key='.$_POST['key'].'&err=passNull');
}

$conn->close();

?>

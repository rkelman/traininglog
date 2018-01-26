<?php
include_once('connection.php');

function log_cron($cronName, $msg) {
  $log_conn = connectDB();

  $logSql = "INSERT into daxLogs
     (logDateTime, app, message)
     VALUES
     (now(), '".$cronName."', '".$msg."')";

  echo $logSql."<BR>\n";

  $insLog=$log_conn->query($logSql);

  $log_conn->close();
}
?>

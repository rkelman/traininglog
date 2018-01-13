<?php
  echo "<html>\n";
  echo "<head>\n<link rel=\"stylesheet\" href=\"traininglog.css\">\n";
  echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
  echo "</head>\n";
  echo "<body>\n";
  echo "Please enter e-mail to reset password<BR><BR>";
  echo "<form action=\"reset-val.php\" method=\"post\">\n";
  echo "eMail: ";
  echo "<input type=\"text\" name=\"email\"><BR>\n";
  echo "<input type=\"submit\" name=\"Request Reset\"><BR>\n";
  echo "</form>\n";
  echo "</body>\n";
  echo "</html>";
?>

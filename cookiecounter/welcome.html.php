<?php include $_SERVER['DOCUMENT_ROOT'] . '/radhikasonar/includes/helpers.inc.php'; ?>
	
	<!-- don't forget to change server path -->
	
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Cookie counter</title>
  </head>
  <body>
    <p>
      <?php
      if ($visits > 1)
      {
        echo "This is visit number $visits.";
      }
      else
      {
        // First visit
        echo 'Welcome to my website! Click here for a tour!';
      }
      ?>
    </p>
  </body>
</html>

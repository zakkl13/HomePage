<?php
    date_default_timezone_set($_SESSION["timezone"]);

    $cur24hr = date('G');
    define("MORNING", 6);
    define("AFTERNOON", 12);
    define("EVENING", 17);
    define("NIGHT", 20);

    if ($cur24hr >= NIGHT) {
      $timeofday = NIGHT;
      $welcome = "Good Evening, ";
      $ampm = "PM";
    } elseif ($cur24hr >= EVENING) {
      $timeofday = EVENING;
      $welcome = "Good Evening, ";
      $ampm = "PM";
    } elseif ($cur24hr >= AFTERNOON) {
      $timeofday = AFTERNOON;
      $welcome = "Good Afternoon, ";
      $ampm = "PM";
    } else {
      $timeofday = MORNING;
      $welcome = "Good Morning, ";
      $ampm = "AM";
    }

?>

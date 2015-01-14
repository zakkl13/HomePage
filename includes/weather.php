<?php
$result = file_get_contents('http://weather.yahooapis.com/forecastrss?p=' . $_SESSION["zipcode"] . '&u=f');
$xml = simplexml_load_string($result);
$xml->registerXPathNamespace('yweather', 'http://xml.weather.yahoo.com/ns/rss/1.0');
$location = $xml->channel->xpath('yweather:location');

if(!empty($location)){
  foreach($xml->channel->item as $item){
    $current = $item->xpath('yweather:condition');
    $forecast = $item->xpath('yweather:forecast');
    $current = $current[0];
    $city = $location[0]['city'];
    $state = $location[0]['region'];
    $curr_temp = $current['temp'] . "&degF";
    $curr_high = $forecast[0]['high'] . "&degF";
    $curr_low = $forecast[0]['low'] . "&degF";
    $img = "http://l.yimg.com/a/i/us/we/52/{$current['code']}.gif";
    $curr_status = $current['text'];
    //forecast day = $forecast[0]['day']
    //forecast status = $forecast[0]['text']
    //forecast high $forecast[0]['high']
    //forecast low $forecast[0]['low']

    }
  }

  if ($_COOKIE["temp"] == "celcius")
  {
    $curr_temp = to_celcius($curr_temp) . "&degC";
    $curr_high = to_celcius($curr_high) . "&degC";
    $curr_low = to_celcius($curr_low) . "&degC";
  }

function to_celcius($temp)
{
  return round(($temp - 32) * (5/9));
}

function forecast()
{
  global $forecast;
  $output = "";
  for ($i = 1; $i < 5; $i++)
  {
    $output .= "<div class=\"col-md-3\"><p>";
    $output .= to_full_day($forecast[$i]['day']);
    $output .= "</p><hr />";
    $output .= "<p>Low: ";
    if ($_COOKIE["temp"] == "celcius") {
      $output .= to_celcius($forecast[$i]['low']);
      $output .= "&degC &nbsp;";
      $output .= "High: ";
      $output .= to_celcius($forecast[$i]['high']);
      $output .= "&degC";
    } else {
      $output .= $forecast[$i]['low'];
      $output .= "&degF &nbsp;";
      $output .= "High: ";
      $output .= $forecast[$i]['high'];
      $output .= "&degF";
    }
    $output .= "</p><p>";
    $output .= $forecast[$i]['text'];
    $output .= "</p>";
    $output .= "</div>";
  }

  return $output;
}

function to_full_day($day)
{
  if ($day == "Mon") {
    return "Monday";
  } else if ($day == "Tue") {
    return "Tuesday";
  } else if ($day == "Wed") {
    return "Wednesday";
  } else if ($day == "Thu") {
    return "Thursday";
  } else if ($day == "Fri") {
    return "Friday";
  } else if ($day == "Sat") {
    return "Saturday";
  } else if ($day == "Sun") {
    return "Sunday";
  }
}

?>

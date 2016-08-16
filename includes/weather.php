<?php
    $BASE_URL = "http://query.yahooapis.com/v1/public/yql";
	$yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places where placetype="Zip" AND text="' . $_SESSION["zipcode"] . '" )';
	$yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json";
//$result = file_get_contents($yql_query_url);
//$xml = simplexml_load_string($result)->results;
//$xml->registerXPathNamespace('yweather', 'http://xml.weather.yahoo.com/ns/rss/1.0');
//$location = $xml->channel->xpath('yweather:location');

  $session = curl_init($yql_query_url);
  curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
  $json = curl_exec($session);
  $weather_object =  json_decode($json);
  $location = $weather_object->query->results->channel[0]->location;
  error_log($location->city);
if(!empty($location)){
	$item = $weather_object->query->results->channel[0]->item;
    $current = $item->condition;
    $forecast = $item->forecast;
    $city = $location->city;
    $state = $location->region;
    $curr_temp = $current->temp . "&degF";
    $curr_high = $forecast[0]->high . "&degF";
    $curr_low = $forecast[0]->low . "&degF";
    $img = "http://l.yimg.com/a/i/us/we/52/{$current->code}.gif";
    $curr_status = $current->text;
    //forecast day = $forecast[0]['day']
    //forecast status = $forecast[0]['text']
    //forecast high $forecast[0]['high']
    //forecast low $forecast[0]['low']

    
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
    $output .= to_full_day($forecast[$i]->day);
    $output .= "</p><hr />";
    $output .= "<p>Low: ";
    if ($_COOKIE["temp"] == "celcius") {
      $output .= to_celcius($forecast[$i]->low);
      $output .= "&degC &nbsp;";
      $output .= "High: ";
      $output .= to_celcius($forecast[$i]->high);
      $output .= "&degC";
    } else {
      $output .= $forecast[$i]->low;
      $output .= "&degF &nbsp;";
      $output .= "High: ";
      $output .= $forecast[$i]->high;
      $output .= "&degF";
    }
    $output .= "</p><p>";
    $output .= $forecast[$i]->text;
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

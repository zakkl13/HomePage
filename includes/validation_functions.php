<?php
$errors = array();

// * presence
// use trim() so empty spaces don't count
// use === to avoid false positives
// empty() would consider "0" to be empty
function has_presence($value) {
	return isset($value) && $value !== "";
}

function validate_presences($required_fields) {
	global $errors;
	foreach ($required_fields as $field) {
		$value = trim($_POST[$field]);
		if (!has_presence($value)) {
			$errors[$field] = ucfirst($field) . " can't be blank";
		}
	}
}

// * string length
// max length
function has_max_length($value, $max) {
	return strlen($value) <= $max;
}

function validate_max_lengths($fields_with_max_lengths) {
	global $errors;
	// Expects an assoc. array
	foreach($fields_with_max_lengths as $field => $max) {
		$value = trim($_POST[$field]);
	  if (!has_max_length($value, $max)) {
	    $errors[$field] = ucfirst($field) . " is too long";
	  }
	}
}

function has_min_length($value, $min) {
	return strlen($value) >= $min;
}

function validate_min_lengths($fields_with_min_lengths) {
	global $errors;
	// Expects an assoc. array
	foreach($fields_with_min_lengths as $field => $min) {
		$value = trim($_POST[$field]);
	  if (!has_min_length($value, $min)) {
	    $errors[$field] = ucfirst($field) . " must have at least {$min} characters";
	  }
	}
}

function validate_zip($zipcode) {
	global $errors;
	if (preg_match('/^[0-9]{5}([- ]?[0-9]{4})?$/', $zipcode)) {
		//do nothing
	} else {
		$errors["zip"] = "Please enter a valid zipcode";
	}
}

function form_errors($errors=array()) {
	$output = "";
	if (!empty($errors)) {
	  $output .= "<div class=\"error\">";
	  $output .= "Please fix the following errors:";
	  $output .= "<ul>";
	  foreach ($errors as $key => $error) {
	    $output .= "<li>";
		$output .= htmlentities($error);
		$output .= "</li>";
	  }
	  $output .= "</ul>";
	  $output .= "</div>";
	}
	return $output;
}

?>

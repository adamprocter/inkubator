<?php

$date = strtotime("June 19, 2014 6:00 PM");
$remaining = $date - time();
$DAYS_REMAINING = floor($remaining / 86400);
//echo $days_remaining;

// Should be the common directory path from the URL, eg 
// '/lp-miniseries-example-php/'
$ROOT_DIRECTORY = preg_replace(
		'/(sample|edition)\/(index.php)?(\?.*?)?$/', '', $_SERVER['REQUEST_URI']);

// $EDITIONS will be an array of arrays.
// Each sub-array be like array("ape.png", "Ape")
$EDITIONS = json_decode(file_get_contents(getcwd().'/../editions.json'));

// Define greetings for different times of the day in different languages.
$GREETINGS = array(
'english'	=> array('Good morning', 'Hello', 'Good evening'),
'french'	=> array('Bonjour', 'Bonjour', 'Bonsoir'),
'german'	=> array('Guten morgen', 'Hallo', 'Guten abend'),
'spanish'	=> array('Buenos días', 'Hola', 'Buenas noches'),
'portuguese'	=> array('Bom dia', 'Olá', 'Boa noite'),
'italian'	=> array('Buongiorno', 'Ciao', 'Buonasera'),
'swedish'	=> array('God morgon', 'Hallå', 'God kväll')
);

function display_validate_config() {
global $GREETINGS;

if (array_key_exists('config', $_POST)) {
$config = $_POST['config'];
} else {
header('HTTP/1.0 400 Bad Request');
print 'There is no config to validate';
exit();
}

// Preparing what will be returned:
$response = array(
'errors' => array(),
'valid' => TRUE
);

// Extract the config from the POST data and parse its JSON contents.
// user_settings will be something like:
// {"name":"Alice", "lang":"english"}.
$user_settings = json_decode(stripslashes($config), TRUE);

// If the user did not choose a language:
if ( ! array_key_exists('lang', $user_settings) || $user_settings['lang'] == '') {
$response['valid'] = FALSE;
array_push($response['errors'], 'Please choose a language from the menu.');
}

// If the user did not fill in the name option:
if ( ! array_key_exists('name', $user_settings) || $user_settings['name'] == '') {
$response['valid'] = FALSE;
array_push($response['errors'], 'Please enter your name into the name box.');
}

if ( ! array_key_exists(strtolower($user_settings['lang']), $GREETINGS)) {
// Given that the select field is populated from a list of languages
// we defined this should never happen. Just in case.
$response['valid'] = FALSE;
array_push($response['errors'], sprintf("We couldn't find the language you selected (%s). Please choose another.", $user_settings['lang']));
}

header('Content-type: application/json');
echo json_encode($response);
}



// Called to generate the sample shown on BERG Cloud Remote.
function display_sample() {
	global $ROOT_DIRECTORY, $EDITIONS,  $GREETINGS, $DAYS_REMAINING;

	$language = 'english';
	$name = 'Otto Says...';
	
	$greeting = sprintf('%s, %s', $GREETINGS[$language][0], $name);
	
	
	// We can choose which edition we want as the sample:
	$edition_number = 0;
	$description = $EDITIONS[$edition_number][0];
	$days_left = $DAYS_REMAINING;
	
	header("Content-Type: text/html; charset=utf-8");
	//header('ETag: "' . md5('sample' . gmdate('dmY')) . '"');
	header('ETag: "' . md5($_GET['delivery_count']) . '"');
	
	require $_SERVER['DOCUMENT_ROOT'] . $ROOT_DIRECTORY . 'template.php';
}


// Called by BERG Cloud to generate publication output to print.
function display_edition() {
	global $ROOT_DIRECTORY, $EDITIONS, $GREETINGS, $DAYS_REMAINING;

	// We ignore timezones, but have to set a timezone or PHP will complain.
	date_default_timezone_set('UTC');


	if (array_key_exists('delivery_count', $_GET)) {
		$edition_number = (int) $_GET['delivery_count'];
	} else {
		// A sensible default.
		$edition_number = 0;
	}

	if (array_key_exists('local_delivery_time', $_GET)) {
		// local_delivery_time is like '2013-10-16T23:20:30-08:00'.
		// We strip off the timezone, as we only need to know the day.
		$date = strtotime(substr($_GET['local_delivery_time'], 0, -6));
		//$date = new DateTime($_GET['local_delivery_time']);
		
	} else {
		// Default to now.
		$date = gmmktime();
	}
	
	if (array_key_exists('lang', $_GET)) {
			$language = $_GET['lang'];
		} else {
			$language = '';
		}
	
	if (($edition_number + 1) > count($EDITIONS)) {
		// The publication has finished, so unsubscribe this subscriber.
		http_response_code(410);

	} else if (in_array(date('l', $date), array('Saturday', 'Sunday'))) {
		// No content is delivered this day.
		http_response_code(204);

	} else {
		// It's all good, so display the publication.
		
		// Pick a time of day appropriate greeting.
		$i = 1;
		//echo $date;
//		$hour = (int) $date->format('G');
//		
//			switch(TRUE) {
//				case in_array($hour, range(0, 3));
//					$i = 2;
//					break;
//				case in_array($hour, range(4, 11));
//					$i = 0;
//					break;
//				case in_array($hour, range(12, 17));
//					$i = 1;
//					break;
//				case in_array($hour, range(18, 23));
//					$i = 2;
//					break;
//			}

		$language = 'english';
		$name = 'Otto the Otter says';
		$days_left = $DAYS_REMAINING;
		
		$description = $EDITIONS[$edition_number][0];
		//$description = $EDITIONS[$edition_number][1];
		
		//echo $description;
		header("Content-Type: text/html; charset=utf-8");
		header('ETag: "' . md5($edition_number . gmdate('dmY')) . '"');
		
		$greeting = sprintf('%s, %s', $GREETINGS[$language][$i], $name);
		require $_SERVER['DOCUMENT_ROOT'] . $ROOT_DIRECTORY . 'template.php';
	}
}

/**
 * For 4.3.0 <= PHP <= 5.4.0
 * PHP >= 5.4 already has a http_response_code() function.
 */
if ( ! function_exists('http_response_code')) {
	function http_response_code($newcode = NULL) {
		static $code = 200;
		if ($newcode !== NULL) {
			header('X-PHP-Response-Code: '.$newcode, true, $newcode);
			if ( ! headers_sent()) {
				$code = $newcode;
			}
		}
		return $code;
	}
}

?>

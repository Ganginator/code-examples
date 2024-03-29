<!-- 
Custom PHP Script for Duluth Homegrown Radio
Copyright 2012-13 Ganginator - Jesse Gangi - Duluth Homegrown Music Festival - Duluth Homegrown Radio
Built by Ganginator for radio.duluthhomegrown.com
-->

<!-- 
	Jesse Gangi
	jessegangi.com
	218 310 2447
	jgangi @ aerialapps.com
	@Ganginator
-->

<!-- 
http://stackoverflow.com/questions/3489773/use-php-to-show-icecast2-statistics
-->


<?php 

/*
 * SCRIPT CONFIGURATIONS 
 */
/* ORIGINAL #2 
$SERVER = 'http://198.20.242.161:8000'; // URL TO YOUR ICECAST SERVER 
*/
$SERVER = 'http://198.61.225.253:8000'; // URL TO YOUR ICECAST SERVER 
$STATS_FILE = '/status.xsl'; // PATH TO STATUS.XSL PAGE YOU CAN SEE IN YOUR BROWSER (LEAVE BLANK UNLESS DIFFERENT) 

///////////////////// END OF CONFIGURATION --- DO NOT EDIT BELOW THIS LINE \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

// create a new curl resource 
$ch = curl_init();

// set url 
curl_setopt($ch,CURLOPT_URL,$SERVER.$STATS_FILE);

// return as a string 
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

// $output = our stauts.xsl file 
$output = curl_exec($ch);

// close curl resource to free up system resources 
curl_close($ch);

// build array to store our radio stats for later use 
$radio_info = array();
$radio_info['server'] = $SERVER;
$radio_info['title'] = '';
$radio_info['description'] = '';
$radio_info['content_type'] = '';
$radio_info['mount_start'] = '';
$radio_info['bit_rate'] = '';
$radio_info['listeners'] = '';
$radio_info['most_listeners'] = '';
$radio_info['genre'] = '';
$radio_info['url'] = '';
$radio_info['now_playing'] = array();
	$radio_info['now_playing']['artist'] = '';
	$radio_info['now_playing']['track'] = '';

// loop through $ouput and sort into our different arrays 
$temp_array = array();

$search_for = "<td\s[^>]*class=\"streamdata\">(.*)<\/td>";
$search_td = array('<td class="streamdata">','</td>');

if(preg_match_all("/$search_for/siU",$output,$matches)) {
	foreach($matches[0] as $match) {
		$to_push = str_replace($search_td,'',$match);
		$to_push = trim($to_push);
		array_push($temp_array,$to_push);
	}
}

// sort our temp array into our ral array 
$radio_info['title'] = $temp_array[0];
$radio_info['description'] = $temp_array[1];
$radio_info['content_type'] = $temp_array[2];
$radio_info['mount_start'] = $temp_array[3];
$radio_info['bit_rate'] = $temp_array[4];
$radio_info['listeners'] = $temp_array[5];
$radio_info['most_listeners'] = $temp_array[6];
$radio_info['genre'] = $temp_array[7];
$radio_info['url'] = $temp_array[8];

$x = explode(" - ",$temp_array[9]);
$radio_info['now_playing']['artist'] = $x[0];
$radio_info['now_playing']['track'] = $x[1];

?>


<!-- ORIGINAL echo 
< ?php 

	echo htmlspecialchars($radio_info['now_playing']['artist'] . ' - ' . $radio_info['now_playing']['track']);
	
?>
-->


<!-- WE'LL MAKE THIS BETTER AS WE GO -->
<?php 

	echo '<hr />';
	echo '<h3 class="player"><u>Playing Now:</u></h3><h4 class="player">';
	echo htmlspecialchars($radio_info['now_playing']['artist']);
	echo '</h4><br />';
	echo htmlspecialchars($radio_info['now_playing']['track']);
	// echo '<br /><hr />';
	// echo 'There are currently<br />';
	// echo htmlspecialchars($radio_info['listeners']);
	// echo ' listeners.';
	echo '<br />';
	echo '<br />';
	
?>
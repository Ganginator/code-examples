 /*!
 * Custom Javascript for Duluth Homegrown Radio 
 * Copyright 2012-13 Ganginator - Jesse Gangi - Duluth Homegrown Music Festival - Duluth Homegrown Radio 
 * Built by Ganginator for radio.duluthhomegrown.com 
 */
 
 /*
	Jesse Gangi 
	jessegangi.com 
	218 310 2447 
	jgangi @ aerialapps.com 
	@Ganginator 
*/

/*
http://tunein.com/radio/Duluth-Homegrown-Radio-s187279/ 
https://itunes.apple.com/us/app/tunein-radio/id418987775?mt=8 
https://play.google.com/store/apps/details?id=tunein.player&hl=en 
*/


if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
	location.replace("http://tunein.com/radio/Duluth-Homegrown-Radio-s187279/");
}


if ( (navigator.userAgent.indexOf('Android') != -1) ) {
	document.location = "http://tunein.com/radio/Duluth-Homegrown-Radio-s187279/";
}


/* reponse.php */
setInterval(function() {
    $('#reload').fadeOut("slow").load('includes/duluth-homegrown-radio-now-playing.php').fadeIn("slow");
}, 10000);


$(document).ready(function(){

	var stream = {
		title: "Duluth Homegrown Radio",
		// mp3: "http://198.20.242.161:7000/;" // ORIGINAL SHOUTcast #2
		// mp3: "http://198.20.242.161:8000/listen" // ORIGINAL Icecast #2
		mp3: "http://198.61.225.253:8000/listen" // New HG Server Icecast ?
	},
	ready = false;

	$("#jquery_jplayer_1").jPlayer({
		ready: function (event) {
			ready = true;
			$(this).jPlayer("setMedia", stream);
		},
		pause: function() {
			$(this).jPlayer("clearMedia");
		},
		error: function(event) {
			if(ready && event.jPlayer.error.type === $.jPlayer.error.URL_NOT_SET) {
				// Setup the media stream again and play it.
				$(this).jPlayer("setMedia", stream).jPlayer("play");
			}
		},
		swfPath: "js",
		supplied: "mp3",
		preload: "none",
		wmode: "window"
	});

});


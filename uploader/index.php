<!-- ROOT/index.php -->


<!DOCTYPE html>


<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->


<head>


	<!-- META -->
	
	
	<meta charset="utf-8" />
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	
	<title>Aerial Applications Uploader Widget</title>
	
	
	<meta name="title" content="Aerial Applications Uploader Widget" />
	<meta name="description" content="This is Aerial Applications Uploader Widget!" />
	<meta name="keywords" content="Aerial Applications, Aerial, Applications, Uploader Widget, Uploader, Widget, Jesse Gangi, Jesse, Gangi, Duluth, Minnesota, MN, Superior, Wisconsin, WI, Twin Ports, Twin, Ports, Northland, Upper Mid-west, Upper, Mid-west, Mid, West, HTML, HTML5, CSS, CSS3, JavaScript, PHP" />
	<meta name="author" content="Jesse Gangi" />
	<meta name="Copyright" content="Copyright &copy; 2014 Aerial Applications, Jesse Gangi" />
	
	
	<!-- Dublin Core Metadata: -->
	<!-- Project Name -->
	<meta name="DC.title" content="Aerial Applications Uploader Widget" />
	<!-- What you're about. -->
	<meta name="DC.subject" content="This is Aerial Applications Uploader Widget!" />
	<!-- Who made this site. -->
	<meta name="DC.creator" content="Jesse Gangi" />
	
	
	<meta name="google-site-verification" content="EMPTY" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	
	<!-- / META -->
	
	
	<!-- CSS -->
	
	
	<!-- Vendors CDNs: -->
	
	
	<!-- Normalize: -->
	<!-- v2.1.3 Compiled, and Minified - VIA CDNJS -->
	<link rel="stylesheet" src="//cdnjs.cloudflare.com/ajax/libs/normalize/2.1.3/normalize.min.css" />
	
	<!-- Bootstrap: -->
	<!-- v3.0.3 Compiled, and Minified - VIA NETDNA -->
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" />
	
	
	<!-- Main: -->
	
	
	<link rel="stylesheet" href="css/uploader.css" />
	
	
	<!-- Custom Vendors: -->
	
	
	<!-- Bootstrap: -->
	<link rel="stylesheet" href="css/customs/custom-bootstrap.css" />
	
	
	<!-- Customs: -->
	
	
	<link rel="stylesheet" href="css/customs/custom.css" />
	
	
	<!-- / CSS -->
	
	
	<!-- JAVASCRIPT HEAD -->
	
	
	<script src="http://modernizr.com/downloads/modernizr-latest.js"></script>
	
	
	<!--[if lt IE 9]>
	
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		
	<![endif]-->
	
	
	<!--[if lt IE 9]>
	
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		
	<![endif]-->
	
	
	<!-- / JAVASCRIPT HEAD -->
	
	
	<!-- FAVICONS -->
	
	
	<link rel="apple-touch-icon-precomposed" href="files/images/favicons/apple-touch-icon-144-precomposed.png" sizes="144x144" />
	<link rel="apple-touch-icon-precomposed" href="files/images/favicons/apple-touch-icon-114-precomposed.png" sizes="114x114" />
	<link rel="apple-touch-icon-precomposed" href="files/images/favicons/apple-touch-icon-72-precomposed.png" sizes="72x72" />
	<link rel="apple-touch-icon-precomposed" href="files/images/favicons/apple-touch-icon-57-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" href="files/images/favicons/apple-touch-icon.png" />
	<link rel="apple-touch-icon-precomposed" href="apple-touch-icon.png" />
	
	<link rel="shortcut icon" href="files/images/favicons/favicon.gif" />
	<link rel="shortcut icon" href="files/images/favicons/favicon.png" />
	<link rel="shortcut icon" href="files/images/favicons/favicon.ico" />
	<link rel="shortcut icon" href="favicon.ico" />
	
	<link rel="icon" href="files/images/favicons/favicon.gif" />
	<link rel="icon" href="files/images/favicons/favicon.png" />
	<link rel="icon" href="files/images/favicons/favicon.ico" />
	<link rel="icon" href="favicon.ico" />
	
	
	<!-- / FAVICONS -->
	
	
</head>


<!-- README.md HIDDEN


<?php include("README.md") ?>


/ README.md HIDDEN -->


<!-- PHP LOGIC --> 


<?php 


// BREAKS
// error_reporting ( E_ALL ); 


/* <!-- PHP VARIABLES --> */ 


$allowed_file_types = array ( "jpg", "jpeg", "png", "gif", "bmp", "zip" ); 
$max_file_size = 1024*5*1024; // CURRENT: 5MB, CHANGE MIDDLE # TO REFLECT MB 

$root = "http://" . $_SERVER [ 'HTTP_HOST' ]; 
$path = $_SERVER [ 'REQUEST_URI' ]; 

$widget_path = 'forms/uploader/'; // WIDGET LOCATION, CHANGE TO YOUR LOCATION // CONSIDE PARTING THIS OUT SO THE uploader DIRECTORY IS INDEPENDENT FROM DROP IN PLUG AND PLAY
$upload_path = "files/uploads/clients/files/images/"; 
$display_path = 'files/uploads/clients/displays/'; 
$log_path = 'files/uploads/clients/logs/'; 
$csv_path = 'files/uploads/clients/csvs/'; 

$images_prefix = 'images_client-'; 
$image_prefix = 'image_client-'; 
$display_prefix = 'display_client-'; 
$log_prefix = 'log_client-'; 
$csv_prefix = 'csv_client-'; 

$client_id = $_POST [ 'client_id' ]; 
$user_name = $_POST [ 'user_name' ]; 
$user_email = $_POST [ 'user_email' ]; 
$user_phone = $_POST [ 'user_phone' ]; 
$image_description = $_POST [ 'image_description' ]; 
$upload_message = $_POST [ 'upload_message' ]; 

$file_name = $_FILES [ 'upload' ] [ 'name' ]; 

$ext = substr ( $file_name, strpos ( $file_name, '.' ), strlen ( $file_name ) -1 ); 

$count = 0; 

$date = date ( 'Y-m-d' ); 


/* <!-- / PHP VARIABLES --> */ 


if ( isset ( $_POST ) and $_SERVER [ 'REQUEST_METHOD' ] == "POST" ) { 

	// LOOP $_FILES TO EXECUTE ALL FILES 
	foreach ( $_FILES [ 'files' ] [ 'name' ] as $f => $file_name ) { 
	
		if ( $_FILES [ 'files' ] [ 'error' ] [ $f ] == 4) { 
		
			continue; // SKIP FILE IF ANY ERROR FOUND 
			
		} 
		
		if ( $_FILES [ 'files' ] [ 'error' ] [ $f ] == 0 ) { 
		
			// ADDED THIS TO VERIFY THE DIRECTORY IS WRITABLE 
			if ( !is_writable ( $upload_path ) ) { 
			
				$alert[] = "You cannot upload to the specified directory, please verify that it is writable, or <a href='mailto:jgangi@aerialapps.com?Subject=Permissions%20Issue%20-%20Client%20$client_id'>Contact</a> an <a href='mailto:jgangi@aerialapps.com?Subject=Permissions%20Issue%20-%20Client%20$client_id'>Administrator</a> by <a href='mailto:jgangi@aerialapps.com?Subject=Permissions%20Issue%20-%20Client%20$client_id'>Clicking Here</a>."; 
				
				continue; // SKIP IF upload_path IS NOT WRITABLE 
				
			/* if ( $_FILES [ 'files' ] [ 'size' ] [ $f ] > $max_file_size ) { ORIGINAL */ 
			} elseif ( $_FILES [ 'files' ] [ 'size' ] [ $f ] > $max_file_size ) { 
			
				$alert[] = "The $file_name file you attempted to upload has exceeded the Max File Size Allowed.<br />(Maximum Allowed File Size: 5MB)"; 
				
				continue; // SKIP FILES THAT ARE TOO LARGE 
				
			} elseif ( ! in_array ( pathinfo ( $file_name, PATHINFO_EXTENSION ), $allowed_file_types ) ){ 
			
				/* $alert[] = "$file_name is not a valid format"; ORIGINAL */
				$alert[] = "The $file_name file type that you attempted to upload is not allowed, and is most likely not an image.<br />(Allowed Image Types: .jpg, .jpeg, .png, .gif, bmp)<br />(We Also Accept '.zip' Archives.)"; 
				
				continue; // SKIP INVALID FILE TYPES
				
			// NO ERROR FOUND, MAKE CLIENT DIRECTORY, AND MOVE UPLOADED FILES 
			} else { 
			
			
				/* FOREVER */
				// CREATE A SAFE, UNIQUE, NON REPEATING FILE NAME, FOREVER 
				
				
				$ext = substr ( $file_name, strpos ( $file_name, '.' ), strlen ( $file_name ) -1 ); 
				
				include ( "forever.php" ); 
				
				$new_file_name = $image_prefix . $client_id . '_' . $date . '_' . $forever . $ext; 
				
				$forever++; 
				
				$filename = "forever.php"; 
				
				$output = '<!-- ROOT/forever.php -->


<?php 


$forever = ' . $forever . '; 


?>'; 
				
				
				$filehandle = fopen ( $filename, 'w' ); 
				fwrite ( $filehandle, $output ); 
				fclose ( $filehandle ); 
				
				
				/* / FOREVER */
				
				
				// NO REASON TO CARE IF THE DIRECTORY EXISTS, BECAUSE WE WANT IT TO GO IN THE SAME DIRECTORY REGARDLESS. 
				// MAKE CLIENT DIRECTORY 
				mkdir ( $upload_path . $images_prefix . $client_id ); 
				// MAKE DATE DIRECTORY 
				mkdir ( $upload_path . $images_prefix . $client_id . '/' . $date ); 
				
				// FIGURE OUT HOW TO DISPLAY ALL IMAGES, MAYBE AS THUMBNAILS?
				// $image_array[] = '<img src="' . $root . '/' . $widget_path . $upload_path . $image_prefix . $client_id . '/' . $_FILES [ 'files' ] [ 'name' ] [ $i ].'" alt="Image not found?" />'; 
				
				// if ( move_uploaded_file ( $_FILES [ "files" ] [ "tmp_name" ] [ $f ], $upload_path . $images_prefix . $client_id . '/' . $date . "/" . $file_name ) ) { 
				if ( move_uploaded_file ( $_FILES [ "files" ] [ "tmp_name" ] [ $f ], $upload_path . $images_prefix . $client_id . '/' . $date . "/" . $new_file_name ) ) { 
				
					$count++; // NUMBER OF SUCCESSFULLY UPLOADED FILES FOR VERIFICATION 
					
				} 
				
			} 
			
		} 
		
	} 
	
} 


?>


<!-- / PHP LOGIC --> 


<body>


	<div id="wrapper">
	
	
		<h1>Uploader Widget</h1>
		
		
		<!-- ERROR ALERTS -->
		
		
		<?php 
		
		# LOOPS THROUGH EACH FILE 
		if ( isset ( $alert ) ) { 
		
			foreach ( $alert as $msg ) { 
			
				printf ( "<p class='error'>%s</p></ br>\n", $msg ); 
				
			} 
			
		} 
		
		?>
		
		
		<!-- / ERROR ALERTS -->
		
		
		<!-- PHP DISPLAY --> 
		
		
		<?php 
		
		# SINGULAR 
		// NONE OF THESE ARE WORKING 
		if ( $count !=0 ) { // THIS WORKS, BUT IT THROWS ERRORS 
		// if ( isset ( $_FILE ) { 
		// if ( isset ( $_POST [ 'upload' ] ) ) { 
		
		
			$display_data = 
			
			'
<!-- ROOT/files/uploads/clients/displays/ -->


<link rel="stylesheet" href="../../../css/image-upload.css">


<div class="item center">
	
	
	<h1>Client Information</h1>
	
	<h2>ID: ' . $client_id . '</h2>
	
	<h2>Name: ' . $user_name . '</h2>
	
	<h3>email: <a href="mailto:' . $user_email . '?Subject=Image%20Upload%20-%20Client%20' . $client_id . '">' . $user_email . '</a></h3>
	
	<h3>Phone: <a href="tel:' . $user_phone . '">' . $user_phone . '</a></h3>
	
	<h1>Upload Information</h1>
	
	<h3>Image:<br />
	<a href="' . $root . '/' . $widget_path . $upload_path . $images_prefix . $client_id . '/' . $date . '/' . $new_file_name . '" target="_blank">' . $root . '/' . $widget_path . $upload_path . $images_prefix . $client_id . '/' . $date . '/' . $new_file_name . '</a><br />
	<br />
	
	<img src="' . $root . '/' . $widget_path . $upload_path . $images_prefix . $client_id . '/' . $date . '/' . $new_file_name . '" alt="Image not found?" />
	
	<h3>Upload Message:<br />
	' . $upload_message . '</h3>
	
	<h3>Client Log File:<br />
	<a href="' . $root . '/' . $widget_path . $log_path . $log_prefix . $client_id . '.txt" target="_blank">'
	 . $root . '/' . $widget_path . $log_path . $log_prefix . $client_id . '.txt</a></h3>
	
	<h3>CSV Data File:<br />
	<a href="' . $root . '/' . $widget_path . $csv_path . $csv_prefix . $client_id . '.csv" target="_blank">'
	 . $root . '/' . $widget_path . $csv_path . $csv_prefix . $client_id . '.csv</a></h3><br />
	<br />
	
	
</div><!-- / .item .center -->'


 . "\n\n\n" . '<hr />' . "\n\n"; 
			
			
			$ret = file_put_contents ( $display_path . $display_prefix . $client_id . '.html', $display_data, FILE_APPEND | LOCK_EX ); 
			
			if ( $ret === false ) { 
			
				// die ( '<p class="error">There was an error writing to the <a href="' . $display_path . $display_prefix . $client_id . '.html" target="_blank">Display File</a>.</p>' ); 
				echo ( '<p class="error">There was an error writing to the <a href="' . $display_path . $display_prefix . $client_id . '.html" target="_blank">Display File</a>.</p>' ); 
				
			} else { 
			
				echo '<p class="success">' . "$ret" . ' bytes written to the <a href="' . $display_path . $display_prefix . $client_id . '.html" target="_blank">Display File</a>.</p>'; 
				
			} 
			
		} else { 
		
			// DISABLED, BUT KEPT. CASUES ISSUES...
			// die ( '<p class="error">Sorry, there is no post data to process a display?</p>' ); 
			// echo ( '<p class="error">Sorry, there is no post data to process a display?</p>' ); 
			
		} 
		
		?>
		
		
		<!-- / PHP DISPLAY --> 
		
		
		<!-- PHP LOG --> 
		
		
		<?php 
		
		
		# SINGULAR 
		if ( $count !=0 ) { 
		
		
			$log_data = 
			
			'Client ID: ' . $client_id . ' | User Name: ' . $user_name . ' | User email: ' . $user_email . ' | User Phone: ' . $user_phone . ' | Upload Message: ' . $upload_message . ' | Image File Name: ' . $file_name . ' | Image Location: ' . $root . '/' . $widget_path . $upload_path . $images_prefix . $client_id . ' | Display Location: ' . $root . '/' . $widget_path . $display_path . ' | Log Location: ' . $root . '/' . $widget_path . $log_path . ' | CSV Location: ' . $root . '/' . $widget_path . $csv_path . '/ END | ' . "\n"; 
			
			
			$ret = file_put_contents ( $log_path . $log_prefix . $client_id . '.txt', $log_data, FILE_APPEND | LOCK_EX ); 
			
			
			if ( $ret === false ) { 
			
				// die ( '<p class="error">There was an error writing to the <a href="' . $log_path . $log_prefix . $client_id . '.txt" target="_blank">Log File</a>.</p>' ); 
				echo ( '<p class="error">There was an error writing to the <a href="' . $log_path . $log_prefix . $client_id . '.txt" target="_blank">Log File</a>.</p>' ); 
				
				
			} else { 
				
				echo '<p class="success">' . "$ret" . ' bytes written to <a href="' . $log_path . $log_prefix . $client_id . '.txt" target="_blank">Log File</a>.</p>'; 
				
			} 
			
			
		} else { 
		
			// die ( '<p class="error">Sorry, there is no post data to process a log?</p>' ); 
			// echo ( '<p class="error">Sorry, there is no post data to process a log?</p>' ); 
			
			
		} 
		
		
		?>
		
		
		<!-- / PHP LOG --> 
		
		
		<!-- PHP CSV --> 
		
		
		<?php 
		
		
		# SINGULAR 
		if ( $count !=0 ) { 
		
		
			// IF FILE EXISTS, DO NOT WRITE THIS LINE
			// 'Client ID, User Name, User email, User Phone, Upload Message, Image File Name, Image Location, Display Location, Log Location' . "\n" . 
			
			
			$csv_data = 
			
			$client_id . ', ' . $user_name . ', ' . $user_email . ', ' . $user_phone . ', ' . $upload_message . ', ' . $file_name . ', ' . $root . '/' . $widget_path . $upload_path . ', ' . $root . '/' . $widget_path . $display_path . ', ' . $root . '/' . $widget_path . $log_path . ', ' . $root . '/' . $widget_path . $csv_path . "\n"; 
			
			
			$ret = file_put_contents ( $csv_path . $csv_prefix . $client_id . '.csv', $csv_data, FILE_APPEND | LOCK_EX ); 
			
			
			if ( $ret === false ) { 
			
				// die ( '<p class="error">There was an error writing to the <a href="' . $csv_path . $csv_prefix . $client_id . '.csv" target="_blank">CSV File</a>.</p>' ); 
				echo ( '<p class="error">There was an error writing to the <a href="' . $csv_path . $csv_prefix . $client_id . '.csv" target="_blank">CSV File</a>.</p>' ); 
				
				
			} else { 
				
				echo '<p class="success">' . "$ret" . ' bytes written to <a href="' . $csv_path . $csv_prefix . $client_id . '.csv" target="_blank">CSV File</a>.</p>'; 
				
			} 
			
			
		} else { 
		
			// die ( '<p class="error">Sorry, there is no post data to process a data CSV?</p>' ); 
			// echo ( '<p class="error">Sorry, there is no post data to process a data CSV?</p>' ); 
			
			
		} 
		
		
		?>
		
		
		<!-- / PHP CSV --> 
		
		
		<!-- EMAIL -->
		
		
		<?php 
		
		
		# SINGULAR 
		if ( $count !=0 ) { 
		
		
			$email_data = 
			
			'New Submission' . "\n\n" . 
			
			'Client ID: ' . $client_id . "\n" . 
			
			'User Name: ' . $user_name . "\n" . 
			
			'User email: ' . $user_email . "\n" . 
			
			'User Phone: ' . $user_phone . "\n\n" . 
			
			'Image Upload:' . "\n" . 
			$root . '/' . $widget_path . $upload_path . $images_prefix . $client_id . '/' . $file_name . "\n\n" . 
			
			'Upload Message:' . "\n" . 
			$upload_message . "\n\n" . 
			
			'Client Log File:' . "\n" . 
			$root . '/' . $widget_path . $log_path . $log_prefix . $client_id . '.txt' . "\n\n" . 
			
			'CSV Data File' . "\n" . 
			$root . '/' . $widget_path . $csv_path . $csv_prefix . $client_id . '.csv'; 
			
			
			$email_subject = 'User Submission: Client ID: ' . $client_id . ' - ' . 'User Name: ' . $user_name . ' - ' . 'User email: ' . $user_email . ' - ' . 'User Phone: ' . $user_phone; 
			$email_message = $email_data; 
			
			mail ( "jgangi@aerialapps.com", $email_subject, $email_message, "From: $user_name" ); 
			
		} 
		
		
		?>
		
		
		<!-- / EMAIL -->
		
		
		<!-- SUCCESS ALERT --> 
		
		
		<?php 
		
		
		# SINGULAR 
		if ( $count !=0 ) { 
		
			printf ( "<p class='success'>%d files added successfully!</p>\n", $count ); 
			
			printf ( "<p class='success'><a href='javascript:history.go(-1)'>Refresh</a></p>" ); 
			
		}
		
		
		?>
		
		
		<!-- / SUCCESS ALERT --> 
		
		
		<form action="" method="post" enctype="multipart/form-data">
		
		
			<h4>Client ID:</h4>
			
			<input name="client_id" type="text" value="" />
			
			<h4>Your Name:</h4>
			
			<input name="user_name" type="text" value="" />
			
			<h4>Your email:</h4>
			
			<input name="user_email" type="text" value="" />
			
			<h4>Your Phone:</h4>
			
			<input name="user_phone" type="text" value="" />
			
			
			<h4>Information:</h4>
			
			<textarea name="upload_message"></textarea><br />
			<br />
			
			
			<div id="image">
			
			
				<h4>Image Upload:</h4>
				
				<input id="image-input" type="file" name="files[]" multiple="multiple" accept="image/*" />
				<small>(Maximum Allowed File Size: 5MB)</small><br />
				<small>(Allowed Image Types: .jpg, .jpeg, .png, .gif, .bmp)</small><br />
				<small>(We Also Accept '.zip' Archives.)</small>
				
				
			</div><!-- / #image --><br />
			<br />
			
			
			<input name="upload" type="submit" value="Send"><br />
			<br />
			
			<input name="clear" type="reset" value="Reset!">
			
			
		</form>
		
		
	</div><!-- / #wrapper -->


</body>


<div id="feet">


	<!-- JAVASCRIPT FEET -->
	
	
	<!-- Libraries CDN: -->
	
	
	<!-- Bootstrap -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	
	
	<!-- / Libraries CDN -->
	
	
	<!-- Customs: -->
	
	
	<script src="js/custom.js"></script>
	
	
	<!-- / Customs -->
	
	
	<!-- Inline: -->
	
	
	<!-- Google Analytics: -->
	<script>
	
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		ga('create', 'UA--????????-?'', ''??????????..com');
		ga('send', 'pageview');
		
	</script>
	
	
	<!-- / Inline -->
	
	
	<!-- / JAVASCRIPT FEET -->
	
	
</div><!-- / #feet -->


</html>



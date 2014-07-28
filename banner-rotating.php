<!-- ./includes/banner-rotating.php -->


<!-- Rotating Hourly Banner Widget -->


<div id="banner-hourly">


	<div id="logic">
	
	
		<!-- Set Variables -->
		
		<?php 
		
			$url = "http://fox21online.com/";
			
			$fileType = "banner";
			$fileOwner = "FOX-21-News";
			$fileOwnerProper = "FOX 21 News, KQDS-DT";
			
			$dayOrder = date("w")+1; // Sunday as 1
			$dayName = date("l");
			
			$hourOrder = date("H");
			$hourNumber = date("g");
			$hourMeridian = date("a");
			
			$timeProper = date("g:i A");
			
			$imageWidth = "1024";
			$imageHeight = "242";
			$imageSize = $imageWidth."x".$imageHeight."px";
			
			$imageFolder = "files/images/banners/rotating/hours/".$dayOrder."_".$dayName."/";
			$imageFile = $fileType."_".$fileOwner."_".$dayOrder."_".$dayName."_".$hourOrder."_".$hourNumber.$hourMeridian."_".$imageSize.".jpg";
			$imageSource = $url.$imageFolder.$imageFile;
			
			$imageAlt = $fileOwnerProper." - ".$dayName.", ".$timeProper;
			$imageTitle = $imageAlt;
			
			if ($hourOrder >= 00 && $hourOrder <= 07) {
				$imageMap = "imageMapMorning";
			}
			elseif ($hourOrder >= 08 && $hourOrder <= 19) {
				$imageMap = "imageMapEvening";
			}
			elseif ($hourOrder >= 20 && $hourOrder <= 23) {
				$imageMap = "imageMapNight";
			}
			else {
				$imageMap = "";
			}
			
		?>
		
		
		<?php
		
			// Friendly Paradox Catcher:
			
			// $pagename = $_GET['pagename'];
			
			if (isset ($_GET['egg'])) {
				$egg = $_GET['egg'];
			}
			else {
				$egg = "EMPTY";
			}
			
			if ($egg == "the-doctor") {
			
				$dayName = "Today";
				
				$hourMeridian = "Outside-of-Time";
				
				$imageFolder = "files/images/banners/rotating/";
				$imageFile = $fileType."_".$fileOwner."_".$dayName."_".$hourMeridian."_".$imageSize.".jpg";
				$imageSource = $url.$imageFolder.$imageFile;
				$imageAlt = "I need The Doctor!";
				$imageTitle = $imageAlt;
				$imageMap = "imageMapTheDoctor";
				
				$display = "display: none;";
				
			}
			
			else if ($egg == "variable-list") {
			
				$display = "";
				
			}
			
			else {
			
				$display = "display: none;";
				
			}
			
			// Most Terrible...
			
		?>
		
		
	</div><!-- / #logic -->
	
	
	<div id="output">
	
	
		<?php 
		
			echo "<img usemap='#banner-tab' src='".$imageSource."' width='".$imageWidth."' height='".$imageHeight."' alt='".$imageAlt."' title='".$imageTitle."' border='0' />";
			
		?>
		
		
		<map id="banner-tab" name="banner-tab">
		
			<area href="http://karitoyota.com" shape="rect" coords="0,0,1024,64" style="outline:none;" alt="KARI TOYOTA" title="KARI TOYOTA" target="_blank" />
			
		</map>
		
		
	</div><!-- / #output -->
	
	
	<?php echo "<div id='variable-list' style='".$display."'>"; ?>
	
	
		<?php
		
			if ($egg == "variable-list") {
			
				include("includes/variable-list.php");
				
			}
			
		?>
		
		
	</div><!-- / #variable-list -->
	
	
</div><!-- / #banner-hourly -->



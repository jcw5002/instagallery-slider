<?php

	//Author: Jason Wagner
	//Copyright 2012, Jason Wagner.
	//Last Modified: 05/20/12
	//Version 1.2
	//Changes: Fixed bug where photos were not sorted by filename. Hides filetype when displaying filename

	//You can modify these properties to customize the look of the gallery
	
	$PAGE_TITLE = "Instagallery - Test (May 19, 2012)";
	$COPYRIGHT_OWNER = "Your Name";
	$BG_COLOR = "#dddddd";
	$TITLE_COLOR = "#333";
	$COPYRIGHT_COLOR = "#999";
	$FILENAMES_COLOR = "#777";
	$SHOW_FILENAMES = true; 	//change this to false to hide them
	
	// ***************************** DO NOT EDIT BELOW THIS LINE ************************************************ //
	
	function getFilesInDirectory($dir){
		if ($handle = opendir($dir)) {
			$files = array();
			while (false !== ($file = readdir($handle))) { 
				if($file<>"." and $file<>".."){
					array_push($files, $file);
				}		
			}
			closedir($handle);
		}
		return $files;
	}
	
	$files_to_skip = array("index.php", ".DS_Store", ".BridgeSort");

?>

<!DOCTYPE html> 
<html lang="en"> 
<head> 
	<title><?= $title . $SITE_TITLE ?></title>
	<meta charset="utf-8" />
	<style type="text/css">

		body {
			background-color: <?= $BG_COLOR ?>;
			font-family: Helvetica, Arial, Sans-serif;
		}
		
		#wrapper {
			overflow: visible;
			width: 100%;
		}
		#photos {
			width: 100%;
			margin-top: 80px;
			overflow: visible;
		}
		
		#pagetitle {
			color: <?= $TITLE_COLOR ?>;
			font-size: 18pt;
			position: fixed;
			top: 4px;
			left: 10px;
		}
	
		#copyright {
			color: <?= $COPYRIGHT_COLOR ?>;
			text-align: center;
			top: 0;
			position: fixed;
			right: 8px;
			padding: 10px;
			font-size: 9pt;
		}
		
		div.filename {
			color: <?= $FILENAMES_COLOR ?>;
			padding: 8px;
			font-size: 10pt;
		}
	
	</style>
</head>
<body>
	<div class="wrapper">
		<h3 id="pagetitle"><?= $PAGE_TITLE ?></h3>
		<div id="copyright">&copy; <?php echo date('Y') . " " . $COPYRIGHT_OWNER; ?></div>
		<div id="photos">
		    <table>
		    	<tr>
				<?php
					$files = getFilesInDirectory("./");
					sort($files);
					foreach($files as $filename) {
						if (in_array($filename, $files_to_skip)) continue;
						echo "\n<td><img src='{$filename}' alt='' />";
						if($SHOW_FILENAMES) {
							$name = substr($filename, 0, strrpos($filename,".") ); //strip filetype
							echo "<div class='filename'>{$name}</div>";
						}
						echo "</td>";	
					}				
				?>	
				</tr>
			</table>
		</div>			
	</div>	
</body>
</html>


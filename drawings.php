<!DOCTYPE HTML>
<!--
/*
 * Bootstrap Image Gallery 2.5.1
 * https://github.com/blueimp/Bootstrap-Image-Gallery
 *
 * Copyright 2011, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
-->
<html lang="en">
<head>
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
<meta charset="utf-8">
<title>Tijana Kojic</title>
<meta name="description" content="Bootstrap Image Gallery is an extension to the Modal dialog of Twitter's Bootstrap toolkit, to ease navigation between a set of gallery images. It features mouse and keyboard navigation, transition effects, fullscreen mode and slideshow functionality.">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/bootstrap-responsive.css">
<!--[if lt IE 7]><link rel="stylesheet" href="css/bootstrap-ie6.min.css"><![endif]-->
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
<link rel="stylesheet" href="css/bootstrap-image-gallery.css">

<link rel="stylesheet" href="css/phocagallery.css">
<link rel="stylesheet" href="css/template.css">
<link rel="stylesheet" href="css/cavans.css">

<link rel="stylesheet" href="css/css.css">

</head>
<body>
<!--<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="#">TIJANA KOJIĆ</a>
            <div class="nav-collapse">
                <?php /*include 'includes/mainMenu.php'; */?>
            	 <ul class="nav">
				    <li><a href="index.php">INDEX</a></li>
				    <li><a href="biography.php">BIOGRAFIJA | BIOGRAPHY</a></li>
				    <li><a href="paintings.php">SLIKE | PAINTINGS</a></li>
				    <li class="active"><a href="drawings.php">CRTEŽI | DRAWINGS</a></li>
				    <li><a href="sculptures.php">SKULPTURE | SCULPTURES</a></li>
				    <li><a href="photos.php">FOTO | PHOTOS</a></li>
				    <li><a href="texts.php">TEKSTOVI | TEXTS</a></li>
				    <li><a href="news.php">VESTI | PRESS & NEWS</a></li>
				    <li><a href="contact.php">KONTAKT | CONTACT</a></li>
				</ul>
            </div>
        </div>
    </div>
</div>-->
<?php include 'includes/header.php'; ?>
<div class="container-fluid">
	
	
    <header></header>
    
    <br />
    <button id="start-slideshow" class="btn btn-large btn-inverse" data-slideshow="5000" data-target="#modal-gallery" data-selector="#gallery [data-gallery=gallery]">SLIDESHOW</button>
	<br />
    	
    
    <div id="gallery" data-toggle="modal-gallery" data-target="#modal-gallery">
    	
    	<?php
    	//echo getcwd(); //'/var/www/theSun/images/drawings'
    	$pictures = array();
		$imageDir = getcwd().'/images/drawings';
    	if ($handle = opendir($imageDir)) {
		    while (false !== ($entry = readdir($handle))) {
		    	if($entry != '.' && $entry != '..'){
		    		$fullFileName = $entry;
					$name = substr($entry, 0, -4);
					$extension = substr($entry, -4);
					
					if(substr($name, -2) != '_s' && substr($name, -2) != '_d'){
						$exp = explode('_', $name);
						$num = $exp[0];
						//echo "$num --- $name<br />";
						$pictures[$num] = $name;
					}
					
				}
					
		    }

			natsort($pictures);
			foreach ($pictures as $num => $name) {
				
				$desc_file = $imageDir.'/'.$name.'_d.txt';
				
				$description_text = file_get_contents($desc_file);
				
				$lines = explode("\n", str_replace("\r", "", $description_text));
				
				$pictureName = '';
				$tech = '';
				$dimension = '';

				$i = 0;
				foreach ($lines as $line)
				{	$i++;
				    // echo '<br />'.$line.'<br />';
				    
				    
				    if($i == 1){
				    	$pictureName = $line;
				    	continue;
				    }
					
					if($i == 2){
				    	$tech = $line;
				    	continue;
				    }
					
					if($i == 3){
				    	$dimension = $line;
				    	continue;
				    }
				}
						    
							
				?>
						
				 <a href="images/drawings/<?php echo $name.'.jpg'; //echo $name.$extension; ?>" 
				 	class="phocagallery-box-file pg-box-image" 
				 	title="<?php echo "$pictureName&nbsp;&nbsp;&nbsp;$tech&nbsp;&nbsp;&nbsp;$dimension"; ?>" 
				 	data-gallery="gallery">
				 	
				 	<!-- <img alt="" src="images/paintings/<?php echo $name."_s".$extension; ?>" width = 205 heigh=205 /> -->
				 	<img alt="" src="images/drawings/<?php echo $name."_s.jpg"; ?>" width = 205 heigh=205 />
				 	<br />
				 	<br />
				 	<span style=" color: black;">
				 		<?php echo "$pictureName<br />$tech<br />$dimension"; ?>
				 	</span>
				 </a>
	   
					
				<?php
						
			}
		
	    }
		
	    closedir($handle);
	
    ?>

    </div>
    
    <br>
</div>
<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade center" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title fontX"></h3> 
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
       <!--
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
       -->
        <a class="btn btn-inverse modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span></span>
        </a>
        <a class="btn btn-inverse modal-next">
            <span></span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
        <a class="btn btn-inverse modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span> Slideshow </span>
        </a>
    </div>
</div>
<script src="js/jquery.js" ></script>
<script src="js/bootstrap.js"></script>
<script src="js/load-image.js"></script>
<script src="js/bootstrap-image-gallery.js"></script>
<script src="js/main.js"></script>
</body> 
</html>

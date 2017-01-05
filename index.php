<?php
require("SimpleFolderGallery/Gallery.php");

$img = new Gallery("./_images");

$images =  $img->getPhotos();
$nav = $img->getNavigation('id');
?>
<html>
<head>
	<meta name="description" content="SimpleFolderGallery" />
	<link rel="stylesheet" type="text/css" href="css/slider.css" media="screen,projection" />  
</head>
<body>
<script type="text/javascript">
/* 
we put next and preview id to global javascript variables
- we will read them later in js/slider.js
 */
window.prev = <?php echo $nav['prev']; ?>;
window.next = <?php echo $nav['next']; ?>;
</script>


<div id="wrapper">
<img src="<?php echo $nav['url']; ?>" class="fit">
</div>

<script src="js/slider.js"></script>
</body>
</html>

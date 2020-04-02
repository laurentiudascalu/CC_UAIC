<?php 
	$url = 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyA29UjoxZzjSS8uG2beY5h-IJhepEvU3-k&sort=popularity&prettyPrint=true';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_REFERER, 'https://proiect-cc-273000.appspot.com/fonts');
	$output = curl_exec($ch);
?>
<!DOCTYPE html>
<html>
<body>
	<nav>
	    <a href="/">Home</a>
	    <a href="map">Map</a>
	    <a href="youtube">Youtube</a>
	    <a href="books">Books</a>
	    <a href="fonts">Fonts</a>
	  </nav>
	  <h1>
	  	Google Fonts
	  </h1>
	  <p>
	  	<?php echo $output; ?>
	  </p>
</body>
</html>

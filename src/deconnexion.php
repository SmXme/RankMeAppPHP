	<?php 
		session_start();
		$_SESSION=array();
		session_destroy();
		header('Refresh: 5; URL="index.php"');
	?>
	
	
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>RankmeApp</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <div class="divContainer">
      <?php
        include 'header.php';
      ?>
	<div class="divScriptConnexion block textcenter">
		<p>Déconnexion effectuée avec succès.</p>
		<p>Redirection vers l'accueil dans 5 secondes...</p>
		<a href="index.php">Retour au site</a>
	</div>
  </div>
  <?php
      include 'footer.php';
  ?>
</body>
</html>

	
	
	
	
	
	
	
	
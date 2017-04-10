	<?php 
    include 'dbconnect.php';
	
	$pass_hash = sha1($_POST['inputPasswordConnexion']);
	$req = $bdd->prepare('SELECT userid FROM membres WHERE login = ? AND password = ?');
	$req->execute(array(htmlspecialchars($_POST['inputLoginConnexion']),$pass_hash));
	$resultat = $req->fetch();
	if (!$resultat){
		echo 'Mauvais identifiant ou mot de passe !';
	}
	else{
		session_start();
		$_SESSION['userid']=$resultat['userid'];
		$_SESSION['userlogin']=$_POST['inputLoginConnexion'];
		header('Refresh: 5; URL="index.php"');
	}
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
		<p>Authentification effectuée avec succès.</p>
		<p>Redirection vers l'accueil dans 5 secondes...</p>
		<a href="index.php">Retour au site</a>
	</div>
  </div>
  <?php
      include 'footer.php';
  ?>
</body>
</html>

	
	
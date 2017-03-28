<!doctype html>
<?php
	$_SESSION['idPlayer']=$_GET['id'];
?>
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
	<header>
		<div class="textcenter block divRS">
			<a href="https://twitter.com/CSGO_FR" ><div class="divIconSocial"><img class ="imgRS" src="images/logotwitter100.png" alt="Logo Twitter"></div></a>
			<a href="https://www.facebook.com/groups/CSGOFRANCE/" ><div class="divIconSocial"><img class ="imgRS" src="images/logofacebook100.png" alt="Logo Facebook"></div></a>
			<a href="http://steamcommunity.com/gid/103582791437214772" ><div class="divIconSocial"><img class ="imgRS" src="images/logosteam100.png" alt="Logo Steam"></div></a>
			<a href="https://www.youtube.fr" ><div class="divIconSocial"><img class ="imgRS" src="images/logoyoutube100.png" alt="Logo YouTube"></div></a>
		</div>
		<nav class="block textcenter">
			<a><div><img id="logoNav" src="images/logocsgofr.png" alt="Logo CSGOFR"></div></a>
			<a class ="navLink" href="index.php"><div class="textNav">Accueil</div></a>
			<a class ="navLink" href=""><div class="textNav">Serveurs</div></a>
			<a class ="navLink" href=""><div class="textNav">Connexion</div></a>
			<a class ="navLink" href="register.php"><div class="textNav">Inscription</div></a>
        </nav>
    </header>
	<div class="divInfoPlayer textcenter block">
			<?php 
			try
					{
						$bdd = new PDO('mysql:host=localhost;dbname=rankme_test;charset=utf8', 'root', '');
					}
					catch (Exception $e)
					{
						die('Erreur : ' . $e->getMessage());
					}
				$idPlayer = (int)$_SESSION['idPlayer'];
				$rqPlayer = $bdd->query('SELECT * FROM rankme WHERE id='.$idPlayer.'');		
				while($donnees = $rqPlayer -> fetch()){
					echo('<div>'.$donnees['steam'].''.$donnees['lastip'].'</div>');
				}
				$rqPlayer->closeCursor();						
			?>	
	</div>
  </div>
    <footer class="block textcenter">
      Footer
    </footer >
</body>
</html>

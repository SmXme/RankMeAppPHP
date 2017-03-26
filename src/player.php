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
		<div class="textcenter divRS">
			Réseaux Sociaux
		</div>
		<nav class="textcenter">
			<div class="textcenter divMenu">
				<div class="textcenter divLogo">
					Logo
				</div>
			</div>
        </nav>
    </header>
	<div class="divInfoPlayer">
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
    <footer class="textcenter">
      Footer
    </footer >
</body>
</html>

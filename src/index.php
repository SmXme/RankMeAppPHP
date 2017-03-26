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
    <div id="divStatsGlobales" class="textcenter">
		Statistiques Globales
    </div>
    <div id="divClassement" class="textcenter">
		<form method="post" action="index.php">
		<label for="selectTop">Top :</label>
		<select name="selectTop">
			<option value=""></option>
			<option value="0">Tout afficher</option>
			<option value="5">5</option>
			<option value="10">10</option>
			<option value="50">50</option>
			<option value="100">100</option>
		</select>		
		<label for="selectTri">Trier par :</label>
		<select name="selectTri">
			<option value=""></option>
			<option value="Score">Score</option>
			<option value="KDR">KDR</option>
			<option value="HS">% Headshots</option>
			<option value="Hits">% Balles Touchées</option>
			<option value="PlWeapons">Armes les plus utilisées</option>
		</select>
		<input type="submit" value="Trier"/>
		
		</form>
		 <?php
			$test="      ";
		 	$errorMessage = "";
			if(!empty($_POST['selectTop']) AND !empty($_POST['selectTri'])){
				try
				{
					$bdd = new PDO('mysql:host=localhost;dbname=rankme_test;charset=utf8', 'root', '');
				}
				catch (Exception $e)
				{
					die('Erreur : ' . $e->getMessage());
				}
				switch ($_POST['selectTri']){
					case "":
						$reponse = $bdd->query('SELECT id, name, score FROM rankme ORDER BY score DESC LIMIT 25');
						while($donnees = $reponse -> fetch()){							
						echo ('<a href="player.php"><div class="divSql textcenter">'.$donnees['name'].''.$donnees['id'].'</div></a>');
						}
						$reponse->closeCursor();
						break;
						
					case "Score":
						$reponse = $bdd->query('SELECT id, name, score FROM rankme ORDER BY score DESC LIMIT '.$_POST['selectTop']);
						while($donnees = $reponse -> fetch()){
							echo ('<a href="player.php?id='.$donnees['id'].'"><div class="divSql textcenter">'.$donnees['name'].' '.$donnees['score'].'</div></a>');
						}
						$reponse->closeCursor();
						break;
						
					case "KDR":
						$reponse = $bdd->query('SELECT name, kills/deaths AS \'Ratio\' FROM rankme ORDER BY Ratio DESC LIMIT '.$_POST['selectTop']);
						while($donnees = $reponse -> fetch()){
							echo ('<div class="divSql textcenter">'.$donnees['name']."   ".$donnees['Ratio'].'</div>');
						}
						$reponse->closeCursor();
						break;
						
					case "HS":
						$reponse = $bdd->query('SELECT name, score FROM rankme ORDER BY score DESC');
						while($donnees = $reponse -> fetch()){
							echo ('<div class="divSql textcenter">'.$donnees['name'].'       '.$donnees['score'].'</div>');
						}
						$reponse->closeCursor();
						break;
						
					case "Hits":
						$reponse = $bdd->query('SELECT name, score FROM rankme ORDER BY score DESC');
						while($donnees = $reponse -> fetch()){
							echo ('<div class="divSql textcenter">'.$donnees['name'].'       '.$donnees['score'].'</div>');
						}
						$reponse->closeCursor();
						break;	
						
					case "PlWeapons":
						$reponse = $bdd->query('SELECT name, score FROM rankme ORDER BY score DESC');
						while($donnees = $reponse -> fetch()){
							echo ('<div class="divSql textcenter">'.$donnees['name'].'       '.$donnees['score'].'</div>');
						}
						$reponse->closeCursor();
						break;					
				}
			}
			else
			{
				$errorMessage="Veuillez sélectionner un affichage ainsi qu'un tri";
				echo $errorMessage;
			}
		?>
    </div>
  </div>
    <footer class="textcenter">
      Footer
    </footer >
</body>
</html>

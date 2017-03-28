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
    <div id="divStatsGlobales" class="block textcenter">
		Statistiques Globales
    </div>
    <div id="divClassement" class="block textcenter">
		<form method="post" action="index.php">
			<div class="divFormClassement">
				<label for="selectTop">Top :</label>
				<select name="selectTop">
					<option value=""></option>
					<option value="Tout afficher">Tout afficher</option>
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select>		
			</div>
			<div class="divFormClassement">
				<label for="selectTri">Trier par :</label>
				<select name="selectTri">
					<option value=""></option>
					<option value="Score">Score</option>
					<option value="KDR">KDR</option>
					<option value="HS">% Headshots</option>
					<option value="Hits">% Balles Touchées</option>
					<option value="PlWeapons">Armes les plus utilisées</option>
				</select>
			</div>
			<div class="divFormClassement">
				<input type="submit" value="Trier"/>
			</div>
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
						$reponse = $bdd->query('SELECT id, name, steam, score FROM rankme ORDER BY score DESC');
						while($donnees = $reponse -> fetch()){							
						echo ('<a class="linkClassement" href="player.php?id='.$donnees['id'].'"><div class="divSql textcenter">'.$donnees['name'].' '.$donnees['steam'].' '.$donnees['score'].'</div></a>');							
							echo('<div class="divSepareSql"></div>');
						}
						$reponse->closeCursor();
						break;
						
					case "Score":
						if (!$_POST['selectTop']=="Tout afficher"){
							$reponse = $bdd->query('SELECT id, name, score FROM rankme ORDER BY score DESC LIMIT '.$_POST['selectTop']);
							while($donnees = $reponse -> fetch()){
								echo ('<a class="linkClassement" href="player.php?id='.$donnees['id'].'"><div class="divSql textcenter">'.$donnees['name'].' '.$donnees['score'].'</div></a>');
								echo('<div class="divSepareSql"></div>');							
							}
							$reponse->closeCursor();
							break;
						}
						else{
							$reponse = $bdd->query('SELECT id, name, score FROM rankme ORDER BY score DESC');
							while($donnees = $reponse -> fetch()){
								echo ('<a class="linkClassement" href="player.php?id='.$donnees['id'].'"><div class="divSql textcenter">'.$donnees['name'].' '.$donnees['score'].'</div></a>');
								echo('<div class="divSepareSql"></div>');							
							}
							$reponse->closeCursor();
							break;							
						}
					case "KDR":
						if (!$_POST['selectTop']=="Tout afficher"){
							$reponse = $bdd->query('SELECT id, name, kills/deaths AS \'Ratio\' FROM rankme ORDER BY Ratio DESC LIMIT '.$_POST['selectTop']);
							while($donnees = $reponse -> fetch()){
								echo ('<a class="linkClassement" href="player.php?id='.$donnees['id'].'"><div class="divSql textcenter">'.$donnees['name']."   ".$donnees['Ratio'].'</div></a>');
								echo('<div class="divSepareSql"></div>');								
							}
							$reponse->closeCursor();
							break;
						}
						else{
							$reponse = $bdd->query('SELECT id, name, kills/deaths AS \'Ratio\' FROM rankme ORDER BY Ratio DESC');
							while($donnees = $reponse -> fetch()){
								echo ('<a class="linkClassement" href="player.php?id='.$donnees['id'].'"><div class="divSql textcenter">'.$donnees['name']."   ".$donnees['Ratio'].'</div></a>');
								echo('<div class="divSepareSql"></div>');								
							}
							$reponse->closeCursor();
							break;							
						}
					case "HS":
						$reponse = $bdd->query('SELECT id, name, score FROM rankme ORDER BY score DESC');
						while($donnees = $reponse -> fetch()){
							echo ('<a class="linkClassement" href="player.php?id='.$donnees['id'].'"><div class="divSql textcenter">'.$donnees['name'].'       '.$donnees['score'].'</div></a>');
							echo('<div class="divSepareSql"></div>');
						}
						$reponse->closeCursor();
						break;
						
					case "Hits":
						$reponse = $bdd->query('SELECT id, name, score FROM rankme ORDER BY score DESC');
						while($donnees = $reponse -> fetch()){
							echo ('<a class="linkClassement" href="player.php?id='.$donnees['id'].'"><div class="divSql textcenter">'.$donnees['name'].'       '.$donnees['score'].'</div></a>');
							echo('<div class="divSepareSql"></div>');							
						}
						$reponse->closeCursor();
						break;	
						
					case "PlWeapons":
						$reponse = $bdd->query('SELECT id, name, score FROM rankme ORDER BY score DESC');
						while($donnees = $reponse -> fetch()){
							echo ('<a class="linkClassement" href="player.php?id='.$donnees['id'].'"><div class="divSql textcenter">'.$donnees['name'].'       '.$donnees['score'].'</div></a>');
							echo('<div class="divSepareSql"></div>');							
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
    <footer class="block textcenter">
		Footer
    </footer >
</body>
</html>

<?php
	session_start();
	$_SESSION['idPlayer']=$_GET['id'];
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
	<div class="divInfoPlayer textcenter block">
		
			<?php
                include 'dbconnect.php';
				$idPlayer = (int)$_SESSION['idPlayer'];
				$rqPlayer = $bdd->query('SELECT * FROM rankme WHERE id='.$idPlayer.'');		
				while($donnees = $rqPlayer -> fetch()){
					$namePlayer = $donnees['name'];
					$steamPlayer = $donnees['steam'];
					$scorePlayer = $donnees['score'];
					$killsPlayer = $donnees['kills'];
					$deathsPlayer = $donnees['deaths'];
					$shotsPlayer = $donnees['shots'];
					$hitsPlayer = $donnees['hits'];
					$headshotsPlayer = $donnees['headshots'];
					$connectedPlayer = $donnees['connected'];
					$lastconnectPlayer = $donnees['lastconnect'];
					$glockPlayer = $donnees['glock'];
					$hkp2000Player = $donnees['hkp2000'];
					$p250Player = $donnees['p250'];
					$deaglePlayer = $donnees['deagle'];
					$elitePlayer = $donnees['elite'];
					$fivesevenPlayer = $donnees['fiveseven'];
					$tec9Player = $donnees['tec9'];
					$novaPlayer = $donnees['nova'];
					$xm1014Player = $donnees['xm1014'];
					$mag7Player = $donnees['mag7'];
					$sawedoffPlayer = $donnees['sawedoff'];
					$bizonPlayer = $donnees['bizon'];
					$mac10Player = $donnees['mac10'];
					$mp9Player = $donnees['mp9'];
					$mp7Player = $donnees['mp7'];
					$ump45Player = $donnees['ump45'];
					$p90Player = $donnees['p90'];
					$galilarPlayer = $donnees['galilar'];
					$ak47layer = $donnees['ak47'];
					$scar20Player = $donnees['scar20'];
					$famasPlayer = $donnees['famas'];
					$m4a1Player = $donnees['m4a1'];
					$augPlayer = $donnees['aug'];
					$ssg08Player = $donnees['ssg08'];
					$ssg556Player = $donnees['sg556'];
					$awpPlayer = $donnees['awp'];
					$g3sg1Player = $donnees['g3sg1'];
					$m249Player = $donnees['m249'];
					$negevPlayer = $donnees['negev'];
				}
				$rqPlayer->closeCursor();						
				
			?>	
			<h2>Informations et Performances de <?php echo $namePlayer ?></h2>
		<div class="divInfoPlayerGeneral">	
			<div class="divInfoPlayer2">
				<p class="pTitle">Pseudo</p>
				<p><?php echo $namePlayer?></p>
			</div>
						
			<div class="divInfoPlayer2">
				<p class="pTitle">SteamID</p>
				<p><?php echo $steamPlayer ?></p>
			</div>
						
			<div class="divInfoPlayer2">
				<p class="pTitle">Temps passé sur le serveur</p>
				<?php
                    $hours = floor($connectedPlayer / 3600);
                    $minutes = (($connectedPlayer/3600) - $hours)*60  ;
                    $secondes =($minutes - floor($minutes))*60;
                ?><p><?php echo $hours . ' h ' .floor($minutes). ' m ' . $secondes;?> </p>
			</div>
            <div class="divInfoPlayer2">
                <p class="pTitle">Dernière visite sur le serveur</p>
                <p><?php
                echo date( 'd / m / Y', $lastconnectPlayer );
                ?></p>
            </div>
		</div>			
		<div class="divInfoPlayerScore">
			<div class="divInfoPlayer2">
				<p class="pTitle">Kills</p>
				<p><?php echo $killsPlayer?></p>
			</div>		
			
			<div class="divInfoPlayer2">
				<p class="pTitle">Deaths</p>
				<p><?php echo $deathsPlayer?></p>
			</div>
						
			<div class="divInfoPlayer2">
				<p class="pTitle">Ratio</p>
				<p>
                    <?php echo number_format(($killsPlayer/$deathsPlayer), 1, '.', ' '); ?>
                </p>

			</div>
						
			<div class="divInfoPlayer2">
				<p class="pTitle">Score</p>
				<p><?php echo $scorePlayer ?></p>
			</div>
		</div>
		<div class="divInfoPlayerTirs">
			<div class="divInfoPlayer2">
				<p class="pTitle">Shots</p>
				<p><?php echo $shotsPlayer ?></p>
			</div>
						
			<div class="divInfoPlayer2">
				<p class="pTitle">Hits</p>
				<p><?php echo $hitsPlayer ?></p>
			</div>
						
			<div class="divInfoPlayer2">
				<p class="pTitle">Précision</p>
				<p>
                    <?php echo number_format(($hitsPlayer/$shotsPlayer)*100, 1, '.', ' ').'%';?>
                </p>
			</div>
								
			<div class="divInfoPlayer2">
				<p class="pTitle">Headshots</p>
				<p><?php echo $headshotsPlayer?></p>
			</div>
		</div>
	</div>
  </div>
  <?php
      include 'footer.php';
  ?>
</body>
</html>

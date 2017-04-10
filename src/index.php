<?php
	session_start();
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
    <?php
        include 'header.php';
    ?>
  <div class="divContainer">
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
             include 'dbconnect.php';
				if (!empty($_POST['selectTri']) AND !empty($_POST['selectTop'])) {
                    switch ($_POST['selectTri']) {
                        case "":
                            $reponse = $bdd->query('SELECT id, name, score FROM rankme ORDER BY score DESC LIMIT 10');
                            while ($donnees = $reponse->fetch()) {
                                echo('<a class="linkClassement" href="player.php?id=' . $donnees['id'] . '"><div class="divSql textcenter">' . $donnees['name'] . ' ' . $donnees['score'] . '</div></a>');
                                echo('<div class="divSepareSql"></div>');
                            }
                            $reponse->closeCursor();
                            break;

                        case "Score":
                            if ($_POST['selectTop'] == "Tout afficher") {
                                $reponse = $bdd->query('SELECT id, name, score FROM rankme ORDER BY score DESC');
                                while ($donnees = $reponse->fetch()) {
                                    echo('<a class="linkClassement" href="player.php?id=' . $donnees['id'] . '"><div class="divSql textcenter">' . $donnees['name'] . ' ' . $donnees['score'] . '</div></a>');
                                    echo('<div class="divSepareSql"></div>');
                                }
                            } else {
                                $reponse = $bdd->query('SELECT id, name, score FROM rankme ORDER BY score DESC LIMIT ' . $_POST['selectTop']);
                                while ($donnees = $reponse->fetch()) {
                                    echo('<a class="linkClassement" href="player.php?id=' . $donnees['id'] . '"><div class="divSql textcenter">' . $donnees['name'] . ' ' . $donnees['score'] . '</div></a>');
                                    echo('<div class="divSepareSql"></div>');
                                }
                            }
                            $reponse->closeCursor();
                            break;

                        case "KDR":
                            if ($_POST['selectTop'] == "Tout afficher") {
                                $reponse = $bdd->query('SELECT id, name, kills/deaths AS "Ratio" FROM rankme ORDER BY Ratio DESC');
                                while ($donnees = $reponse->fetch()) {
                                    $ratio_format = number_format($donnees['Ratio'], 1, '.', ' ');
                                    echo('<a class="linkClassement" href="player.php?id=' . $donnees['id'] . '"><div class="divSql textcenter">' . $donnees['name'] . "   " . $ratio_format . '</div></a>');

                                    echo('<div class="divSepareSql"></div>');
                                }
                                $reponse->closeCursor();
                                break;
                            } else {
                                $reponse = $bdd->query('SELECT id, name, kills/deaths AS \'Ratio\' FROM rankme ORDER BY Ratio DESC LIMIT ' . $_POST['selectTop']);
                                while ($donnees = $reponse->fetch()) {
                                    $ratio_format = number_format($donnees['Ratio'], 1, '.', ' ');
                                    echo('<a class="linkClassement" href="player.php?id=' . $donnees['id'] . '"><div class="divSql textcenter">' . $donnees['name'] . "   " . $ratio_format . '</div></a>');
                                    echo('<div class="divSepareSql"></div>');
                                }
                                $reponse->closeCursor();
                                break;
                            }
                        case "HS":
                            if ($_POST['selectTop'] == "Tout afficher") {
                                $reponse = $bdd->query('SELECT id, name, (headshots/kills)*100 AS "HS" FROM rankme ORDER BY HS DESC');
                                while ($donnees = $reponse->fetch()) {
                                    $hs_format = number_format($donnees['HS'], 0, '.', ' ').'%';
                                    echo('<a class="linkClassement" href="player.php?id=' . $donnees['id'] . '"><div class="divSql textcenter">' . $donnees['name'] . '       ' . $hs_format.'</div></a>');
                                    echo('<div class="divSepareSql"></div>');
                                }
                                $reponse->closeCursor();
                                break;
                            } else {
                                $reponse = $bdd->query('SELECT id, name, (headshots/kills)*100 AS "HS" FROM rankme ORDER BY HS DESC LIMIT ' . $_POST['selectTop']);
                                while ($donnees = $reponse->fetch()) {
                                    $hs_format = number_format($donnees['HS'], 0, '.', ' ').'%';
                                    echo('<a class="linkClassement" href="player.php?id=' . $donnees['id'] . '"><div class="divSql textcenter">' . $donnees['name'] . "   " . $hs_format . '</div></a>');
                                    echo('<div class="divSepareSql"></div>');
                                }
                                $reponse->closeCursor();
                                break;
                            }
                        case "Hits":
                            if ($_POST['selectTop'] == "Tout afficher") {
                                $reponse = $bdd->query('SELECT id, name, (hits/shots)*100 AS "Précision" FROM rankme ORDER BY Précision DESC');
                                while ($donnees = $reponse->fetch()) {
                                    $precision_format = number_format($donnees['Précision'], 1, '.', ' ').'%';
                                    echo('<a class="linkClassement" href="player.php?id=' . $donnees['id'] . '"><div class="divSql textcenter">' . $donnees['name'] . '       ' . $precision_format . '</div></a>');
                                    echo('<div class="divSepareSql"></div>');
                                }
                                $reponse->closeCursor();
                                break;
                            } else {
                                $reponse = $bdd->query('SELECT id, name, (hits/shots)*100 AS "Précision" FROM rankme ORDER BY Précision DESC LIMIT ' . $_POST['selectTop']);
                                while ($donnees = $reponse->fetch()) {
                                    $precision_format = number_format($donnees['Précision'], 1, '.', ' ').'%';
                                    echo('<a class="linkClassement" href="player.php?id=' . $donnees['id'] . '"><div class="divSql textcenter">' . $donnees['name'] . '       ' . $precision_format . '</div></a>');
                                    echo('<div class="divSepareSql"></div>');
                                }
                                $reponse->closeCursor();
                                break;
                            }

                        case "PlWeapons":
                            $reponse = $bdd->query('SELECT id, name, score FROM rankme ORDER BY score DESC');
                            while ($donnees = $reponse->fetch()) {
                                echo('<a class="linkClassement" href="player.php?id=' . $donnees['id'] . '"><div class="divSql textcenter">' . $donnees['name'] . '       ' . $donnees['score'] . '</div></a>');
                                echo('<div class="divSepareSql"></div>');
                            }
                            $reponse->closeCursor();
                            break;
                    }
                }
                else {
                    $reponse = $bdd->query('SELECT id, name, score FROM rankme ORDER BY score DESC LIMIT 3');
                    while ($donnees = $reponse->fetch()) {
                        echo('<a class="linkClassement" href="player.php?id=' . $donnees['id'] . '"><div class="divSql textcenter">' . $donnees['name'] . ' ' . $donnees['score'] . '</div></a>');
                        echo('<div class="divSepareSql"></div>');
                    }
                    $reponse->closeCursor();
                }
		?>
    </div>
  </div>
    <?php
        include 'footer.php';
    ?>
</body>
</html>

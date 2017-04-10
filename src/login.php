<?php
session_start();
?>

<!doctype html>

<?php
    include 'dbconnect.php';
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

      <?php
        include 'header.php';
      ?>
	<div class="divLogin block textcenter">
		<h1>Connexion</h1>
		<form method="POST" action="connexion.php">
			<div class="divFormLogin">
				<label for="inputLoginConnexion">Pseudo: </label>
				<input type="text" placeholder="Login" id="inputLoginConnexion" name="inputLoginConnexion" />		
			</div>
			<div class="divFormLogin">
				<label for="inputPasswordConnexion">Mot de Passe: </label>				
				<input type="password" placeholder="Password" id="inputPasswordConnexion" name="inputPasswordConnexion" />				
			</div>		
			<div class="divFormLogin">
				<label for="cbLogin"> Connexion automatique </label>
				<input type="checkbox" name="cbLogin" id="cbLogin" value="Connexion"/>
			</div>
			<div class="divFormLogin">
				<input type="submit" name ="submitLogin" value="Connexion"/>
			</div>				
		</form>
		
		
		
	</div>
  </div>
  <?php
    include 'footer.php';
  ?>
</body>
</html>

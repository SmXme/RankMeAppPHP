<!doctype html>

<?php
	try
	{	
		$bdd = new PDO('mysql:host=localhost;dbname=rankme_test;charset=utf8', 'root', '');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	
	if (isset($_POST['submitRegister'])){
		$safeLogin = htmlspecialchars($_POST['inputLogin']);
		$safeMail1 = htmlspecialchars($_POST['inputMail1']);
		$safeMail2 = htmlspecialchars($_POST['inputMail2']);
		$safePassword1 = sha1($_POST['inputPassword1']);
		$safePassword2 = sha1($_POST['inputPassword2']);
		$pseudoLength = strlen($safeLogin);
		
		if(!empty($_POST['inputLogin']) AND !empty($_POST['inputPassword1']) AND !empty($_POST['inputPassword2']) AND !empty($_POST['inputMail1']) AND !empty($_POST['inputMail2'])){
			if($pseudoLength <= 255){
				if($safeMail1 == $safeMail2){
					$checkMail = $bdd -> prepare("SELECT * FROM membres WHERE email= ?");
					$checkMail->execute(array($safeMail1));
					$mailExist = $checkMail->rowCount();
					if($mailExist == 0){
						if($safePassword1 == $safePassword2){
							$insererMembre=$bdd->prepare("INSERT INTO membres (login, password, email) VALUES (?, ?, ?)");
							$insererMembre->execute(array($safeLogin, $safePassword1, $safeMail1));
							$errorRegister= "Félicitations, votre enregistrement est valide !";
						}
						else{
							$errorRegister="Vos password ne sont pas identiques !";
						}
					}
					else{
						$errorRegister = "Adresse mail déjà utilisée !";
					}
				}
				else{
					$errorRegister="Vos adresses mail ne sont pas identiques !";
				}
			}
			else{
				$errorRegister="Votre pseudo ne doit pas dépasser 255 caractères !";
			}
		}
		else{
			$errorRegister="Tous les champs doivent être complétés !";
		}
	}
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
	<div class="divRegister block textcenter">
		<h2>Inscription</h2>
		<br /><br /><br />
		<form method="POST" action="">
			<div class="divFormRegister">
				<label for="inputLogin">Pseudo: </label>
				<input type="text" placeholder="Login" id="inputLogin" name="inputLogin" value="<?php if(isset($safeLogin)){ echo $safeLogin;}?>" />		
			</div>
			<div class="divFormRegister">
				<label for="inputPassword1">Mot de Passe: </label>				
				<input type="password" placeholder="Password" id="inputPassword1" name="inputPassword1" />				
			</div>
			<div class="divFormRegister">
				<label for="inputPassword2">Confirmation du Mot de Passe: </label>			
				<input type="password" placeholder="Password" id="inputPassword2" name="inputPassword2" />
			</div>
			<div class="divFormRegister">
				<label for="inputMail1">Email: </label>
				<input type="email" placeholder="Mail1" id="inputMail1" name="inputMail1" value="<?php if(isset($safeMail1)){ echo $safeMail1;}?>"/>			
			</div>
			<div class="divFormRegister">
				<label for="inputMail2">Confirmation de l'Email : </label>
				<input type="email" placeholder="Mail2" id="inputMail2" name="inputMail2" value="<?php if(isset($safeMail2)){ echo $safeMail2;}?>"/>
			</div>
			<div class="divFormRegister">
				<input type="submit" name ="submitRegister" value="S'enregister"/>
			</div>
		</form>
		<?php
		if (isset($errorRegister)){
			echo $errorRegister;
		}
		?>
	</div>
  </div>
    <footer class="block textcenter">
      Footer
    </footer >
</body>
</html>

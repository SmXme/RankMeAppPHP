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
	<div class="divRegister textcenter">
		<h2>Inscription</h2>
		<br /><br /><br />
		<form method="POST" action="">
			<table>
				<tr>
					<td align="right">
						<label for="inputLogin">Login: </label>
					</td>
					<td>
						<input type="text" placeholder="Login" id="inputLogin" name="inputLogin" value="<?php if(isset($safeLogin)){ echo $safeLogin;}?>" />
					</td>
				</tr>
				<tr>
					<td align="right">
						<label for="inputPassword1">Password: </label>
					</td>
					<td>
						<input type="password" placeholder="Password" id="inputPassword1" name="inputPassword1" />
					</td>
				</tr>
				<tr>
					<td align="right">
						<label for="inputPassword2">Password Confirmation: </label>
					</td>
					<td>
						<input type="password" placeholder="Password" id="inputPassword2" name="inputPassword2" />
					</td>
				</tr>				
				<tr>
					<td align="right">
						<label for="inputMail1">Email: </label>
					</td>				
					<td>
						<input type="email" placeholder="Mail1" id="inputMail1" name="inputMail1" value="<?php if(isset($safeMail1)){ echo $safeMail1;}?>"/>
					</td>
				</tr>
				<tr>
					<td align="right">
						<label for="inputMail2">Email Confirmation: </label>
					</td>				
					<td>
						<input type="email" placeholder="Mail2" id="inputMail2" name="inputMail2" value="<?php if(isset($safeMail2)){ echo $safeMail2;}?>"/>
					</td>
				</tr>			
			</table>
			<input type="submit" name ="submitRegister" value="Register"/>
		</form>
		<?php
		if (isset($errorRegister)){
			echo $errorRegister;
		}
		?>
	</div>
  </div>
    <footer class="textcenter">
      Footer
    </footer >
</body>
</html>

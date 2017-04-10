<header>
		<div id="divTest" class="textcenter block divRS">
			<a href="https://twitter.com/CSGO_FR" ><div class="divIconSocial"><img class ="imgRS" src="images/logotwitter100.png" alt="Logo Twitter"></div></a>
			<a href="https://www.facebook.com/groups/CSGOFRANCE/" ><div class="divIconSocial"><img class ="imgRS" src="images/logofacebook100.png" alt="Logo Facebook"></div></a>
			<a href="http://steamcommunity.com/gid/103582791437214772" ><div class="divIconSocial"><img class ="imgRS" src="images/logosteam100.png" alt="Logo Steam"></div></a>
			<a href="https://www.youtube.fr" ><div class="divIconSocial"><img class ="imgRS" src="images/logoyoutube100.png" alt="Logo YouTube"></div></a>
		</div>
		<nav class="block textcenter">
			<a><div><img id="logoNav" src="images/logocsgofr.png" alt="Logo CSGOFR"></div></a>
			<a class ="navLink" href="index.php"><div class="textNav">Accueil</div></a>
			<?php
				if (!isset($_SESSION['userid']) AND !isset($_SESSION['userlogin'])){
                    ?>
                    <a class ="navLink" href="login.php"><div class="textNav">Connexion</div></a>
                    <a class ="navLink" href="register.php"><div class="textNav">Inscription</div></a>
                    <?php
                }
                else{
                    ?>
                    <a class ="navLink" href="moncompte.php"><div class="textNav">Mon Compte</div></a>
                    <a class ="navLink" href="deconnexion.php"><div class="textNav">Deconnexion</div></a>
                    <?php
                    echo 'Bonjour '.$_SESSION['userlogin'];
                }
			?>
</nav>
</header>
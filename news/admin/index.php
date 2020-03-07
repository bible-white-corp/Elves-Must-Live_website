<?php	session_start();
// © Jérome Réaux : http://j-reaux.developpez.com - http://www.jerome-reaux-creations.fr
// ---------------------------------------------------
// ADMIN NEWS : IDENTIFICATION
// ---------------------------------------------------
// CONFIGURATION GENERALE + de la NEWS
	require(dirname(__DIR__) . '/config/main_config.php');
	require(dirname(__DIR__) . '/'.NEWS_FONCTIONS.'fct_toutes_fonctions_necessaires.php');
	// Configuration des News
	include(dirname(__DIR__) . '/'.NEWS_MOD_NEWS.'news_config.php');
// ----------------------------------
// Protection de page index ADMIN
	include_once(__DIR__ . '/_includes/_protect_index.php');
// ------------------------------------------------------
// sinon affichage du formulaire d'identification
?>
<!DOCTYPE html>
<html dir="ltr">
<head>
<!-- META -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="author" content="Jérome Réaux - http://j-reaux.developpez.com" />
	<meta name="robots" content="noindex,nofollow" />
<!-- CSS -->
	<link rel="stylesheet" media="screen" type="text/css" href="./css/adm_theme_style.css" />
	<title>News | Administration des Articles</title>
</head>

<body>
<div id="containerCentrer">

	<h1>Administration des Articles</h1>

	<!-- identification - connexion -->
	<div id="boxIndexIdentificationForm">
		<form method="post" action="./index.php">
		<fieldset>
			<h3><img src="./icones/verrouiller.png" alt="" /> Identifiez-vous :</h3>

<?php	if(isset($msgerreur) && $msgerreur!='') { ?>
			<p class="boxMsgErreur"><?php echo $msgerreur; ?></p>
<?php	} ?>
			<p>
				<label for="idlogin" style="text-align:right;">Identifiant : </label>
				<input id="idlogin" name="login" size="20" />
			</p>

			<p>
				<label for="idpass" style="text-align:right;">Mot de passe : </label>
				<input id="idpass" name="pass" type="password" size="20" />
			</p>
			<p style="text-align:center;">
				<button class="btConnexion" name="btConnexion" type="submit" title="Connexion">
				<span>Connexion</span></button>
			</p>

		</fieldset>
		</form>

			<p style="text-align:center;">
				<!-- retour au site -->
				<a class="aRetourSite" href="../index.php"><span>Retour au site</span></a>
			</p>
	</div>

</div>
</body>
</html>
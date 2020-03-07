<?php
// © Jérome Réaux : http://j-reaux.developpez.com - http://www.jerome-reaux-creations.fr
// -----------------------------------------------------------
// ADMIN : creation Mot de passe
// -----------------------------------------------------------
// CONFIGURATION GENERALE + de la NEWS
	require(dirname(__DIR__) . '/config/main_config.php');
	require(dirname(__DIR__) . '/'.NEWS_FONCTIONS.'fct_toutes_fonctions_necessaires.php');
	// Configuration des News
	include(dirname(__DIR__) . '/'.NEWS_MOD_NEWS.'news_config.php');
// -----------------------------------------------------------
// Fonctions spéciales : Création/vérification de mot de passe hashé
	include_once(__DIR__ . '/_includes/_fct_speciales.php');
// ------------------------------------------------------
// Mot de passe
	$MDPclair 	= '';
	$MDPhash 	= '';
if (isset($_POST['MDPclair']) && $_POST['MDPclair']!='') {
	$MDPclair 	= trim($_POST['MDPclair']);
	$MDPhash 	= CreateHashPassword($_POST['MDPclair']);
}
// ---------------------------------------------------
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
	<title>News | Création manuelle d'un mot de passe hashé</title>
</head>

<body>
<div id="containerCentrer">
<h1>Administration</h1>

	<!-- Création d'un mot de passe -->
	<div id="boxIndexIdentificationForm" style="width:500px;">
		<form method="post" action="./adm-createpwd.php">
		<fieldset>
			<h3>Création manuelle<br />d'un mot de passe hashé</h3>
			<p><i>Par sécurité :</i><br />le Mot de passe hashé devra être copié <b>manuellement</b> dans la base de données</p>

			<p><!-- Mot de passe -->
			<label for="idMDPclair">Mot de passe : </label>
			<input id="idMDPclair" name="MDPclair" type="text" value="<?php echo $MDPclair; ?>" style="width:150px;" />
			</p>

			<!-- Mdp hashé -->
			<p><label>Mdp hashé : </label><?php echo $MDPhash; ?>&nbsp;</p>

			<p style="text-align:center;">
				<button class="btConnexion" name="btConnexion" type="submit" title="Connexion">
				<span>Générer le Mot de passe</span></button>
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
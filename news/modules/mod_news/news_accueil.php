<?php // © Jérome Réaux : http://j-reaux.developpez.com - http://www.jerome-reaux-creations.fr ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
<!-- META -->
	<meta charset="utf-8" />
	<meta name="robots" content="index, follow" />
	<meta name="author" content="Jérome Réaux - http://j-reaux.developpez.com" />
<!-- CSS -->
	<link rel="stylesheet" media="screen" type="text/css" href="./template/css/theme_style.css" />
	<link rel="stylesheet" media="screen" type="text/css" href="./modules/mod_news/css/news_style.css" />
	<title>News | Système de News avec photo + fichier joint</title>
</head>

<body>
<div id="containerCentrer">

	<div id="newsPageAccueil">
		<h1>PHP - Système de Gestion-Affichage de Nouvelles</h1>
		<h2>(PHP-GESTION-NEWS-v5 : PDO/Procédural)<br />
		Avec éditeur wysiwyg, photo et fichier joint</h2>
		<h3><a onclick="window.open(this.href); return false;" href="http://j-reaux.developpez.com/tutoriel/php/gestion-news/">Installation - Configuration</a></h3>
		<h3><a href="./index_news_liste.php">SITE (listing des News)</a></h3>
		<h3><a href="./admin/index.php">Partie ADMINISTRATION (gestion des News)</a></h3>
	</div>

	<div class="newsFiche">
		<div class="newsFicheEntete">
			<div class="newsFicheTitre">
			<h4>Système de Gestion-Affichage de Nouvelles</h4>
			</div>
		</div>
		<div class="newsFicheContenu">
			<a href="./template/img/2012-JR-PUBLICITE-A4-web.pdf" onclick="javascript:window.open(this.href); return false;">
			<img class="newsFichePhoto" src="./template/img/2012-JR-PUBLICITE-A4-web.jpg" alt="" style="width:200px;"/></a>
			<h5><b>PHP-GESTION-NEWS-v5 : PDO/Procédural</b><br />
			Avec éditeur wysiwyg, photo et fichier joint</h5>

			<p>Ce système de News avec photo et fichier joint vous permettra de gérer vous-même votre News, actualité, info...<br />
			Il devrait s'intégrer facilement dans votre site. </p>
			<p>La possibilité de joindre une photo, un fichier et la mise en forme grâce à un éditeur wysiwyg sont des plus !</p>

			<h5>Cette source est parfaitement fonctionnelle en l'état.</h5>
			<p>Néanmoins, quelques adaptations seront nécessaires pour bonne intégration dans votre site :</p>
			<ul>
				<li>adaptation des styles à votre design ;</li>
				<li>intégration dans votre page actualites.php (par exemple) ;</li>
				<li>...</li>
			</ul>
			<h5>Cette source est aussi un tutoriel.</h5>
			<p>Les fichiers contiennent de nombreux commentaires, qui ont valeur pédagogique ...</p>
		</div>
	</div>

	<!-- COPYRIGHT - debut -->
	<div id="containerCopyright">
		<!-- Copyright -->
		<i>Infographie - Programmation - WebDesign : </i>Copyright 2009<?php echo (2011<date('Y')) ? '-'.date('Y') : ''; ?> &copy; 
		<a href="http://jr.profil.free.fr/WEB" onclick="window.open(this.href); return false;" title="Site Web de Jérôme Réaux Créations"><i>Jérôme Réaux Créations</i></a> 
		<br />Open Source : Les sources sont libres de droits et vous pouvez les utiliser et les modifier à votre convenance.
	</div>

</div>
</body>
</html>
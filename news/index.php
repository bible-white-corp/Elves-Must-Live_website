<?php if( session_id()=='' ){ session_start(); }
header('Content-type:text/html; charset=UTF-8');	// encodage UTF-8
//error_reporting(E_ALL); 	// en TEST !!
?>
<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html><head>
		<title>Elves Must Live - News</title>
		<meta charset="utf-8">
        <link rel="icon" type="image/png" href="../images/logosimple.png" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<link rel="stylesheet" href="../assets/css/main.css">
		<!--[if lte IE 9]><link rel="stylesheet" href="../assets/css/ie9.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-article-visible">
		<!-- Wrapper -->
			<div id="wrapper">

					<div id="main" style="display: flex !important; width: 100% !important;">



						<?php 
						// ---------------------------------------------------
						// © Jérome Réaux : http://j-reaux.developpez.com - http://www.jerome-reaux-creations.fr
						// LISTING des News -> indiquez le chemin correct
							include(__DIR__.'/modules/mod_news/news_liste_colonne.php');
						// ---------------------------------------------------
						?>
                               <center><a href="../index.php" class="button">Retour</a></center> 



					</div>

				<!-- Footer -->
					<footer id="footer" style="">
						<p class="copyright" style="display: none;">© Bible White Corp.</p>
					</footer>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>

			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

</body></html>
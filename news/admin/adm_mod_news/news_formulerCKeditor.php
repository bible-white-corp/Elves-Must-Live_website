<?php
// © Jérome Réaux : http://j-reaux.developpez.com - http://www.jerome-reaux-creations.fr
// ---------------------------------------------------
// protection ADMIN - Connexion - CONFIGURATION
	include_once(dirname(__DIR__) . '/_includes/html0.php');
// ---------------------------------------------------
// ADMIN NEWS : FORMULAIRE "Ajouter"/"Modifier"/"Supprimer"
// ---------------------------------------------------
// Editeur WYSIWYG utilisé : CKeditor
	include_once(dirname(dirname(__DIR__)) . '/utilitaires/CKeditor/ckeditor.php') ;
// -----------------
	$traiter 			= '';
if (isset($_POST['traiter']) && in_array($_POST['traiter'],array('Ajouter','Modifier','Supprimer'))) {
	$traiter 			= $_POST['traiter'];
} else {
	// sinon retour a la liste
	header('location: ./news_liste.php');
	exit;
}

// -------------------------
// Ajouter
if ($traiter=='Ajouter')
{
	$newsId 			= 0;
}
// -------------------------
// Modifier / Supprimer
elseif (in_array($traiter, array('Modifier','Supprimer')))
{
	$newsId 			= intval($_POST['newsId']);
}
// -------------------------
// On récupère les infos dans la BD (ou Initialisation si Ajouter)
	include(dirname(dirname(__DIR__)) . '/'.NEWS_MOD_NEWS.'news_data_fromBD.php');
?>
<?php	include_once(dirname(__DIR__) . '/_includes/html1.php'); ?>
<title>News | <?php echo $traiter; ?> un Article</title>
<?php	include_once(dirname(__DIR__) . '/_includes/html2.php'); ?>
<h1>Administration des Articles</h1>

<div id="containerTop">
	<h2><?php echo $traiter; ?> un Article</h2>
	<!-- Retour -->
	<div id="boxBoutonTopRight">
		<a class="aLienRetour" href="./news_liste.php"><span>Retour à la Liste</span></a>
	</div>
</div>
<?php
// -------------------------
// initialisation
	$validNews 				= 0;
	$MsgValidOK 			= '';
	$MsgErreurChamps 		= '';
	$msgErreurPhoto 		= '';
	$msgErreurFile 			= '';
// -------------------------
// TRAITEMENT SI FORMULAIRE envoyé
if(isset($_POST['bt'.$traiter.'News']) && isset($_POST['codevalid']) && $_POST['codevalid']==$_SESSION['codevalid'])
{
	include_once(__DIR__ . '/_inclus/news_traiter.php');
}
// On crée un code de validation, pour éviter le rafraichissement du formulaire (F5)
// (Si "Ajouter" : éviter de copier plusieurs fois le même enregistrement)
$_SESSION['codevalid']		= rand (10000, 90000);
// -------------------------
// AFFICHAGE du RECAPITULATIF
if($validNews==1)
{
	include_once(__DIR__ . '/_inclus/news_recap.php');
}
// -------------------------
// AFFICHAGE du FORMULAIRE
else
{
?>

<?php if (in_array($traiter, array('Ajouter', 'Modifier'))) { ?>
	<!-- SCRIPT de VALIDATION du formulaire -->
	<script type="text/javascript" src="./js/news_validFormulaire<?php echo NEWS_EDITEUR_WYSIWYG; ?>.js"></script>
	<!-- Editeur WYSIWYG : CKeditor -->
	<script type="text/javascript" src="../../utilitaires/CKeditor/ckeditor.js"></script>
<?php } ?>
<!-- scripts - fin -->

<div class="containerContenu">

<?php	if ($MsgErreurChamps!='' || $msgErreurPhoto!='' || $msgErreurFile!='') { ?>
			<?php echo ($MsgErreurChamps!='')? 	'<div class="boxMsgErreur">'.$MsgErreurChamps.'</div>' : ''; ?>
			<?php echo ($msgErreurPhoto!='')? 	'<div class="boxMsgErreur">'.$msgErreurPhoto.'</div>' : ''; ?>
			<?php echo ($msgErreurFile!='')? 	'<div class="boxMsgErreur">'.$msgErreurFile.'</div>' : ''; ?>
<?php	} ?>

<!-- formulaire -->
<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="newsValidFormulaire(); return false;">
<fieldset>
	<input type="hidden" name="codevalid" value="<?php echo $_SESSION['codevalid']; ?>" />
	<input type="hidden" name="traiter" value="<?php echo $traiter; ?>" />
	<input type="hidden" name="newsId" value="<?php echo $newsId; ?>" />
	<input type="hidden" name="newsDate" value="<?php echo $newsDate; ?>" />
	<input type="hidden" name="newsPhotoAvant" value="<?php echo $newsPhotoAvant; ?>" />
	<input type="hidden" name="newsFileAvant" value="<?php echo $newsFileAvant; ?>" />

<?php // -------------------------
if (in_array($traiter, array('Ajouter', 'Modifier')))
{
?>
	<div id="containerContenuGauche">
		<h4>Article</h4>

		<p><!-- Publier ? -->
			<label><acronym title="Afficher l'Article sur le site ?">Publier</acronym> l'Article ? </label>
<?php		$Publier_Array = array(
							1	=>	'Oui',
							0	=>	'Non'
							);
			$pubAbbr_Array = array(
							1 	=>	'Oui, Publié sur le site',
							0 	=>	'Non, mais l\'Article est conservé (archivé)'
							);
			foreach ($Publier_Array as $val => $nom){
				$checked = ($newsPublier==$val)? ' checked="checked"' : '';
?>			<input class="radioInput" id="idnewsPublier<?php echo $val; ?>" name="newsPublier" type="radio" value="<?php echo $val; ?>"<?php echo $checked; ?> />
			<label class="radioLabel" for="idnewsPublier<?php echo $val; ?>"><abbr title="<?php echo $pubAbbr_Array[$val]; ?>"><?php echo $nom; ?></abbr> </label>
<?php 		} ?>
		</p>

		<p><!-- Titre -->
			<label for="idnewsTitre">Titre <abbr title="obligatoire">*</abbr>: </label>
			<input type="text" id="idnewsTitre" name="newsTitre" size="80" value="<?php echo $newsTitre; ?>" />
		</p>

		<p><!-- Contenu :  Editeur WYSIWYG CKeditor -->
			<label for="idArticleContenu">Contenu <abbr title="obligatoire">*</abbr>:</label><br />
			<textarea id="idnewsContenu" name="newsContenu" class="CKeditor"><?php echo $newsContenu; ?></textarea>
		</p>
			<script type="text/javascript">CKEDITOR.replace( 'newsContenu' );</script>

	</div>

	<div id="containerContenuDroit">
		<h4>Photo</h4>

<?php	if ($newsPhotoAvant!=''){ // remarque : EN LOCAL, fctaffichimage() nécessite un chemin relatif ?>
		<p><!-- Photo -->
			<img <?php echo fctaffichimage('../../'.NEWS_REP_PHOTOS.$newsPhotoAvant, 150, 150); ?> alt="<?php echo $newsPhotoAvant; ?>" title="<?php echo $newsPhotoAvant; ?>" />
			<span style="float:right">
			<label class="checkboxLabel" for="idnewsPhotoDelete">Supprimer ? </label>
			<input class="checkboxInput" id="idnewsPhotoDelete" type="checkbox" name="newsPhotoDelete" value="ON" />
			</span>
		</p>
<?php	} ?>

		<p><!-- upload Photo -->
			<label for="idnewsPhoto"><?php echo ($newsPhotoAvant=='')? 'Joindre une Photo' : 'Changer de Photo'; ?> : (<?php echo NEWS_EXTENSION_PHOTO; ?>) </label><br />
			<input type="file" id="idnewsPhoto" name="newsPhoto" size="25" onchange="testExtension('idnewsPhoto','<?php echo htmlspecialchars(NEWS_EXTENSION_PHOTO); ?>');" />
		</p>
		<p id="boxnewsPhotoLargeur" style="display:none;">
			<!-- largeur Photo -->
			<label for="idnewsPhotoLargeur">Largeur (affichage) : </label>
			<select id="idnewsPhotoLargeur" name="newsPhotoLargeur" size="1">
<?php			$PhoW_array 	= array(
								100 		=> 'mini : 100px',
								200 		=> 'petit : 200px',
								300 		=> 'normal : 300px',
								450 		=> 'moyen : 450px',
								600 		=> 'maxi : 600px'
								);
				foreach ($PhoW_array as $PhoW_val => $PhoW_nom)
				{
					$PhoW_Selected = (isset($newsPhotoLargeur) && $newsPhotoLargeur==$PhoW_val)? ' selected="selected"' : '';
?>					<option value="<?php echo $PhoW_val; ?>"<?php echo $PhoW_Selected; ?>><?php echo $PhoW_nom; ?></option>
<?php 			} ?>
			</select>
		</p>

		<h4>Fichier</h4>

<?php	if ($newsFileAvant!=''){ ?>
		<p><!-- Fichier -->
			<label>Fichier :</label>
			<a href="<?php echo NEWS_ROOT.NEWS_REP_FILES.$newsFileAvant; ?>" title="<?php echo $newsFileAvant; ?>" onclick="javascript:window.open(this.href); return false;">
			<img src="<?php echo REP_ADM_ICONES; ?>PDF.png" alt="<?php echo $newsFileAvant; ?>" /></a>
			<span style="float:right">
			<label class="checkboxLabel" for="idnewsFileDelete">Supprimer ? </label>
			<input class="checkboxInput" id="idnewsFileDelete" type="checkbox" name="newsFileDelete" value="ON" />
			</span>
		</p>
<?php	} ?>

		<p><!-- upload fichier -->
			<label for="idnewsFile"><?php echo ($newsFileAvant=='')? 'Joindre un Fichier' : 'Changer de Fichier'; ?> : (<?php echo NEWS_EXTENSION_FILE; ?>)</label><br />
			<input type="file" id="idnewsFile" name="newsFile" size="25" onchange="testExtension('idnewsFile','<?php echo htmlspecialchars(NEWS_EXTENSION_FILE); ?>');" />
		</p>

		<h4>Validation</h4>

		<div id="boxValidation">
			<div class="aLienAnnuler"><a href="./news_liste.php"><span>Annuler</span></a></div>
			<button class="btValider btValider<?php echo $traiter; ?>" name="bt<?php echo $traiter; ?>News" type="submit">
			<span>Valider <?php echo $traiter; ?></span></button>
		</div>

		<div id="boxLoading"></div>

	</div>

<?php
} // -------------------------
elseif ($traiter=='Supprimer')
{
?>
	<div id="containerContenuGauche">
		<h4>Article</h4>

		<p><!-- Publier ? (oui-non) -->
			<label><acronym title="Afficher l'Article sur le site ?">Publier</acronym> : </label>
			<?php if($newsPublier==1) { ?>Oui<?php } elseif($newsPublier==0) { ?>Non<?php } ?>
		</p>

		<p><!-- Titre -->
			<label>Titre : </label>
			<b><?php echo $newsTitre; ?></b>
		</p>
	</div>

	<div id="containerContenuDroit">
<?php	if ($newsPhotoAvant!=''){ // remarque : EN LOCAL, fctaffichimage() nécessite un chemin relatif ?>
		<p><!-- Photo -->
			<label style="min-width:30px;">
			<img <?php echo fctaffichimage('../../'.NEWS_REP_PHOTOS.$newsPhotoAvant, 24, 24); ?> alt="<?php echo $newsPhotoAvant; ?>" title="<?php echo $newsPhotoAvant; ?>" />
			</label>
			(la Photo sera aussi supprimée)
		</p>
<?php	} ?>

<?php	if ($newsFileAvant!=''){ ?>
		<p><!-- Fichier -->
			<a href="<?php echo NEWS_ROOT.NEWS_REP_FILES.$newsFileAvant; ?>" onclick="javascript:window.open(this.href); return false;">
			<label style="min-width:30px;"><img src="<?php echo REP_ADM_ICONES; ?>PDF.png" alt="<?php echo $newsFileAvant; ?>" /></a></label>
			(le fichier sera aussi supprimé)
		</p>
<?php	} ?>

		<h4>Validation</h4>

		<div id="boxValidation">
			<div class="aLienAnnuler"><a href="./news_liste.php"><span>Annuler</span></a></div>
			<button class="btValider btValider<?php echo $traiter; ?>" name="bt<?php echo $traiter; ?>News" type="submit">
			<span>Valider <?php echo $traiter; ?></span></button>
		</div>

		<div id="boxLoading"></div>

	</div>

<?php
}
?>
</fieldset>
</form>
</div>
<?php
} // fin AFFICHAGE du FORMULAIRE
?>
<?php	include_once(dirname(__DIR__) . '/_includes/html3.php'); ?>
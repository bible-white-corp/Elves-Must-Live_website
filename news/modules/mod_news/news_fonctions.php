<?php
// © Jérome Réaux : http://j-reaux.developpez.com - http://www.jerome-reaux-creations.fr
// ---------------------------------------------------
// FONCTIONS D'AFFICHAGE DES NEWS
// ---------------------------------------------------

// ---------------------------------------------------
// 1a/ FONCTION : FICHE de la News (News seule)
// ---------------------------------------------------
function news_affiche_fiche($newsId)
{
	if(is_numeric($newsId) && $newsId>0)
	{
		// -------------------------
		global $pdo;
		// -------------------------
		// On recupere les infos dans la BD
		require(__DIR__ . '/news_data_fromBD.php');
		// -------------------------
?>
		<div class="newsListe">
			<div class="newsFicheEntete">
				<h2 class="newsFicheTitre major"><?php echo $newsTitre; ?></h2>
				<span class="newsFicheDate"> le <?php echo date('d/m/Y &#224; H\hi', $newsDate); ?></span>
			</div>

			<div class="newsFicheContenu">
<?php		if ($newsPhoto != '') { ?>
				<img class="newsFichePhoto" src="<?php echo NEWS_ROOT.NEWS_REP_PHOTOS.$newsPhoto; ?>" alt="" />
<?php		} ?>

				<?php echo $newsContenu; ?>

<?php		if($newsFile != '') { ?>
				<a class="newsFicheFile" href="<?php echo NEWS_ROOT.NEWS_REP_FILES.$newsFile; ?>" onclick="javascript:window.open(this.href); return false;">
				<span>Voir le Fichier joint</span></a>
<?php		} ?>
			</div>
		</div>
<?php
	} else {
		echo 'Mauvais identifiant de News';
	}
};

// ---------------------------------------------------
// 1b/ FONCTION : FICHE de la News (LISTE sur plusieurs colonnes)
// Avec picto, résumé du contenu et lien vers la fiche de l'Article
// ---------------------------------------------------
function news_affiche_fiche_resume_colonne($newsId)
{
	if(is_numeric($newsId) && $newsId>0)
	{
		// -------------------------
		global $pdo;
		// -------------------------
		// On recupere les infos dans la BD
		require(__DIR__ . '/news_data_fromBD.php');
		// -------------------------
		// Nombre de colonnes : 1 à 6 (voir le style CSS : .newsListeColonne)
		$NbreCol	= ( NEWS_NBRE_COLONNE>0 && NEWS_NBRE_COLONNE<7 )? NEWS_NBRE_COLONNE : '';
?>		<article id="empty" style="display: block; width: 50% !important; margin-bottom: 20px; padding-top: 30px !important;" class="active">
		<div class="newsListe newsListeColonne<?php echo $NbreCol; ?>">
			<div class="newsListeEntete">
				<h2 class="newsListeTitre major"><?php echo $newsTitre; ?></h2>
				<span class="newsListeDate"> le <?php echo date('d/m/Y &#224; H\hi', $newsDate); ?></span>
			</div>

			<div class="newsListeContenu">
<?php		if ($newsPhoto != '') { ?>
				<a href="<?php echo NEWS_PATH_FICHE; ?>?newsId=<?php echo $newsId; ?>">
				<img class="newsListePhoto" src="<?php echo NEWS_ROOT.NEWS_REP_PHOTOS.$newsPhoto; ?>" style="width:<?php echo NEWS_LARGEUR_PICTO; ?>px;" alt="" title="<?php echo $newsTitre; ?>" />
				</a>
<?php		} ?>

<?php 			// Résumé du Contenu
				if(NEWS_RESUME_TYPE=='brut'){
					echo texte_resume_brut($newsContenu, NEWS_RESUME_NBRECAR); 
				} elseif(NEWS_RESUME_TYPE=='html'){

					echo html_substr($newsContenu, 0, NEWS_RESUME_NBRECAR, true, " ..."); 
				} else {
					echo $newsContenu; 
				}
									$tmp = NEWS_PATH_FICHE;
					$txt = "<a class=\"newsSuite\" href=\"$tmp?newsId=$newsId\"><span> Afficher en entier</span></a>";
					echo $txt;

?>


<?php		if($newsFile != '') { ?>
				<a class="newsListeFile" href="<?php echo NEWS_ROOT.NEWS_REP_FILES.$newsFile; ?>" onclick="javascript:window.open(this.href); return false;">
				<span>Voir le Fichier joint</span></a>
<?php		} ?>
			</div>
		</div>
		</article>
<?php
	} else {
		echo 'Mauvais identifiant de News';
	}
};

// ---------------------------------------------------
// 2/ FONCTION : LISTING des NEWS (avec résumé du contenu)
// ---------------------------------------------------
function news_affiche_liste_colonne($numPage)
{
	if(is_numeric($numPage) && $numPage>0)
	{
		// -------------------------
		global $pdo;
		// -------------------------
		// requete : toutes les News (CONFIG : Nombre Maxi à afficher -> NEWS_NBRE_MAXITOTAL)
		$news_total_query 		= "SELECT * FROM ".T_NEWS_TABLE." ".
								" WHERE news_publier = 1 ".		// uniquement les news publiées
								" ORDER BY news_date DESC ".
								" LIMIT 0, :newsNbreMaxiTotal ".
								";";
	  try {
		$pdo_select 			= $pdo->prepare($news_total_query);
		$pdo_select->bindValue(':newsNbreMaxiTotal', 	NEWS_NBRE_MAXITOTAL,		PDO::PARAM_INT);
		$pdo_select->execute();
		$news_total_nombre 		= $pdo_select->rowCount();
	  } catch (PDOException $e) { echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
		// -------------------------
		// PAGINATION
		// On calcule le nombre de pages
		$nbreTotalPages 		= ceil($news_total_nombre / NEWS_NBRE_PARPAGE);
		// On calcule le numero du premier message qu'on prend pour le LIMIT de MySQL
		$numDebut 				= ($numPage - 1) * NEWS_NBRE_PARPAGE;
		// -------------------------
		// News à afficher sur la page
		$news_query 			= "SELECT * FROM ".T_NEWS_TABLE." ".
								" WHERE news_publier = 1 ".		// uniquement les news publiées
								" ORDER BY news_date DESC ".
								" LIMIT :numDebut,:newsNbreParPage ".
								";";
	  try {
		$pdo_select 			= $pdo->prepare($news_query);
		$pdo_select->bindValue(':numDebut', 		$numDebut,			PDO::PARAM_INT);
		$pdo_select->bindValue(':newsNbreParPage', 	NEWS_NBRE_PARPAGE,	PDO::PARAM_INT);
		$pdo_select->execute();
		$news_nombre 			= $pdo_select->rowCount();
		$news_rowAll			= $pdo_select->fetchAll();
	  } catch (PDOException $e) { echo 'Erreur SQL : '. $e->getMessage().'<br/>'; die(); }
		// -------------------------
		// Affichage de la PAGINATION
		news_pagination_pages($numPage, $nbreTotalPages); 
?>
		
<?php	// -------------------------
		// Affichage des News
		if($news_nombre>0) {
			foreach ($news_rowAll as $news_row)
			{
				// -------------------------
				$newsId 			= intval($news_row['news_id']);
				// On recupere les infos dans la BD
				require(__DIR__ . '/news_data_fromBD.php');
				// -------------------------
				// Affichage de la news
				news_affiche_fiche_resume_colonne($newsId);
			}
		}
?>

<?php
		// -------------------------
		// Affichage de la PAGINATION
		news_pagination_pages($numPage, $nbreTotalPages);
	}
};

function html_substr( $s, $srt, $len = NULL, $strict=false, $suffix = NULL )
{
	if ( is_null($len) ){ $len = strlen( $s ); }
	
	$f = 'static $strlen=0; 
			if ( $strlen >= ' . $len . ' ) { return "><"; } 
			$html_str = html_entity_decode( $a[1] );
			$subsrt   = max(0, ('.$srt.'-$strlen));
			$sublen = ' . ( empty($strict)? '(' . $len . '-$strlen)' : 'max(@strpos( $html_str, "' . ($strict===2?'.':' ') . '", (' . $len . ' - $strlen + $subsrt - 1 )), ' . $len . ' - $strlen)' ) . ';
			$new_str = substr( $html_str, $subsrt,$sublen); 
			$strlen += $new_str_len = strlen( $new_str );
			$suffix = ' . (!empty( $suffix ) ? '($new_str_len===$sublen?"'.$suffix.'":"")' : '""' ) . ';
			return ">" . htmlentities($new_str, ENT_QUOTES, "UTF-8") . "$suffix<";';
	
	return preg_replace( array( "#<[^/][^>]+>(?R)*</[^>]+>#", "#(<(b|h)r\s?/?>){2,}$#is"), "", trim( rtrim( ltrim( preg_replace_callback( "#>([^<]+)<#", create_function(
            '$a',
          $f
        ), ">$s<"  ), ">"), "<" ) ) );
}
// --------------------------------------------------------------
// FONCTION : PAGINATION (listing des News)
// --------------------------------------------------------------
function news_pagination_pages($numPage, $nbreTotalPages)
{
	// -------------
	$numLimit		= 5; 	// Limite : nombre de pages avant/après la page courante
	$sep			= '';	// Séparateur '', '-', '|', '/' : entre les numéros de pages
	// -------------
	$args 			= preg_replace('#(pg=[0-9]+&?)#', '', $_SERVER['QUERY_STRING']);
	$args 			= (!empty($args))?	'&'.$args : '';
	// -------------
	// PAGINATION
	if($nbreTotalPages > 1) 
	{
?>
		<div class="newsPagination">
<?php	echo $sep;
	  for ($i=1; $i<=$nbreTotalPages; $i++)
	  {
		// 1ère page
		if($i==1 && $numPage>($numLimit+1)) 
		{
			echo ' <a href="?pg='.$i.$args.'" title="Page '.$i.'">'.$i.'</a> '.$sep.'...'.$sep;
		}
		// page courante + $numLimit pages avant et après
		if(($numPage-1-$numLimit)<$i && $i<($numPage+1+$numLimit))
		{
		  if($i==$numPage) { // page courante
			echo ' <b>Page '.$i.'</b> '.$sep;
		  } else {
			echo ' <a href="?pg='.$i.$args.'" title="Page '.$i.'">'.$i.'</a> '.$sep;
		  }
		}
		// dernière page
		if($i==$nbreTotalPages && $numPage<($nbreTotalPages-$numLimit)) 
		{ 
			echo '...'.$sep.' <a href="?pg='.$i.$args.'" title="Page '.$i.'">'.$i.'</a>';
		}
	  }
?>
		</div>
<?php	} 	// (fin if nbreTotalPages)
};

// --------------------------------------------------------------
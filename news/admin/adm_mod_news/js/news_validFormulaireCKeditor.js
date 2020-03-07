/* © Jérome Réaux : http://j-reaux.developpez.com - http://www.jerome-reaux-creations.fr */
/* NEWS - VALIDATION DU FORMULAIRE */

		function newsValidFormulaire() {
			var error 				= '';		
			var setfocus 			= 0;
			var idnewsTitre			= document.getElementById('idnewsTitre');
			var idnewsContenu		= document.getElementById('idnewsContenu');
			var idnewsContenuValue 	= CKEDITOR.instances.idnewsContenu.getData();		// Spécial CKEditor
		
			/* Champs obligatoires */
			if(idnewsTitre.value=='') {
				error += '- Titre de l\'Article\n';
				if(setfocus==0) { idnewsTitre.focus(); }
				setfocus += 1;
			}

			if(idnewsContenuValue=='') {	// Spécial CKEditor
				error += '- Contenu de l\'Article\n';
				if(setfocus==0) { idnewsContenu.focus(); }
				setfocus += 1;
			}

			if(error!='') {
				if(setfocus==1) { alert('Veuillez remplir le champ suivant :\n\n' + error); }
				else { alert('Veuillez remplir les champs suivants :\n\n' + error); }
				return false;
			} else {
				/* affichage d'une barre de progression */
				document.getElementById('boxValidation').style.display = 'none';
				document.getElementById('boxLoading').style.display = 'block';
				/* on envoie le formulaire */
				document.submit();
				return true;
			}
		};

		/* PHOTO/FILE : vérification extension */
		function testExtension(iddiv, extensionsok) {
			var iddiv;
			var valeur		= document.getElementById(iddiv).value.toLowerCase();
			var extensionsok; 
			var chainearray = valeur.split('.');
			var extension 	= chainearray[chainearray.length-1]; /* extension du fichier */
			if(extensionsok.indexOf(extension)==-1) { /* extension pas ok */
				document.getElementById(iddiv).value = '';
				alert('Erreur : ce fichier n\'est pas valide !\n\nExtensions acceptées : ' + extensionsok);
				document.getElementById('boxnewsPhotoLargeur').style.display = 'none';
				return false;
			} else {
				document.getElementById('boxnewsPhotoLargeur').style.display = 'block';
				return true;
			}
		};

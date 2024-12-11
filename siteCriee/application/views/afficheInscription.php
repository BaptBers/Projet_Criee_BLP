<body>
	<p>Voici les informations saisies :</p>
	<ul>
		<li>Login : "<?=$login;?>"</li>
		<li>Raison Sociale : "<?=$raisonSocialeEntreprise;?>"</li>
		<li>Numero habilitation : "<?=$numHabilitation;?>"</li>
		<li>Adresse : "<?=$adresse;?>"</li>
		<li>Ville : "<?=$ville;?>"</li>
		<li>Code Postal : "<?=$cp;?>"</li>
	</ul>
	<p>Faire une autre saisie ? <a href="<?php echo site_url('welcome/contenu/Inscription'); ?>">cliquez ici</a>.</p>
</body>

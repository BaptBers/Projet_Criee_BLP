<body>
	<p>Voici les informations saisies :</p>
	<ul>
		<li>Nom : "<?=$nom;?>"</li>
		<li>Prenom : "<?=$prenom;?>"</li>
		<li>Email : "<?=$email;?>"</li>
	</ul>
	<p>Faire une autre saisie ? <a href="<?php echo site_url('welcome/contenu/Inscription'); ?>">cliquez ici</a>.</p>
</body>

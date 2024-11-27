<body>          
    <h2>Inscription</h2>
	<?php echo validation_errors(); ?>
	<form action="<?php echo site_url('welcome/valider'); ?>" method='POST' class="conn">
		<fieldset id="INFO" name="InfoVI">
			<legend>Vos Informations</legend>
			
			<label for="nom">Nom </label>
			<input type="text" id="nom" name="nom" required/><br><br>
			
			<label for="prenom">Prénom </label>
			<input type="text" id="prenom" name="prenom" required/><br><br>
			
			<label for="email">Adresse email </label>
			<input type="email" id="email" name="email" required/><br><br>
			
			<label for="motdepasse">Mot de passe </label>
			<input type="password" id="motdepasse" name="motdepasse" required/><br><br>
			
			<input type="submit" value="S'inscrire">
			<input type="reset" value="Annuler">
					
		</fieldset>
    <br>
    <a href="<?php echo site_url('welcome/contenu/affichage');?>"><input type="button" value="Retourner à la page d'accueil"></a>
    </form>
</body>
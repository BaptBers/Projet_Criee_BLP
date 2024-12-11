<body>          
    <h2>Formulaire</h2>
	<?php echo validation_errors(); ?>
	<form action="<?php echo site_url('welcome/validerConn'); ?>" method='POST' class="conn">
		<fieldset id="INFO" name="InfoVI">
		<legend>Vos Informations</legend>
		
		<label for="email">Adresse email </label>
		<input type="email" id="email" name="email" required/><br><br>
		
		<label for="motdepasse">Mot de passe </label>
		<input type="password" id="motdepasse" name="motdepasse" required/><br><br>
		
		<input type="submit" value="Valider">
		<input type="reset" value="Annuler">
				
	</fieldset>
    <br>
    <a href="<?php echo site_url('welcome/contenu/affichage');?>" class ="button">Retourner à la page d'accueil</a> 
    </form>
</body>
<body>          
    <h2>Connexion</h2>
	<?php echo validation_errors(); ?>
	<form action="<?php echo site_url('welcome/login'); ?>" method='POST' class="conn">
		<fieldset id="INFO" name="InfoVI">
		<legend>Se connecter</legend>
		
		<label for="login">Login </label>
		<input type="login" id="login" name="login" required/><br><br>
		
		<label for="pwd">Mot de passe </label>
		<input type="password" id="pwd" name="pwd" required/><br><br>
		
		<input type="submit" value="Valider">
		<input type="reset" value="Annuler">
				
	</fieldset>
    <br>
    <a href="<?php echo site_url('welcome/contenu/affichage');?>" class ="button">Retourner à la page d'accueil</a> 
    </form>
</body>
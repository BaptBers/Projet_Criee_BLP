<body>          
    <h2>Inscription</h2>
	<?php echo validation_errors(); ?>
	<form action="<?php echo site_url('welcome/valider'); ?>" method='POST' class="conn">
		<fieldset id="InfoI" name="InfoI">
			<legend>Vos Informations</legend>
			
			<label for="login">Login </label>
			<input type="text" id="login" name="login" required/><br><br>
			
			<label for="raisonSocialeEntreprise">Raison sociale entreprise </label>
			<input type="text" id="raisonSocialeEntreprise" name="raisonSocialeEntreprise" required/><br><br>
			
			<label for="numHabilitation">Numéro d'habilitation </label>
			<input type="text" id="numHabilitation" name="numHabilitation" required/><br><br>

			<label for="adresse">Adresse </label>
			<input type="text" id="adresse" name="adresse" required/><br><br>
			
			<label for="ville">Ville </label>
			<input type="text" id="ville" name="ville" required/><br><br>

			<label for="cp">Code Postal </label>
			<input type="text" id="cp" name="cp" required/><br><br>

			<label for="pwd">Mot de passe </label>
			<input type="password" id="pwd" name="pwd" required/><br><br>
			
			<input type="submit" value="S'inscrire">
			<input type="reset" value="Annuler">
					
		</fieldset>
    <br>
    <a href="<?php echo site_url('welcome/contenu/affichage');?>" class ="button">Retourner à la page d'accueil</a> 
    </form>
</body>
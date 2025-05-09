<body>      
<br><br>    
<?php echo validation_errors(); ?>
<div class="produits-container">
    <form action="<?php echo site_url('welcome/validerInscription'); ?>" method="POST" class="conn">
        <fieldset id="InfoI" name="InfoI">
            <legend>CRÉER SON COMPTE</legend>
            
            <label for="login">Login </label>
            <input type="text" id="login" name="login" required pattern=".{7}" title="Le login doit contenir exactement 7 caractères" maxlength="7"/><br><br>

            <label for="raisonSocialeEntreprise">Raison sociale entreprise </label>
            <input type="text" id="raisonSocialeEntreprise" name="raisonSocialeEntreprise" required/><br><br>

            <label for="numHabilitation">Numéro d'habilitation </label>
            <input type="text" id="numHabilitation" name="numHabilitation" required pattern="^CP\d{9}$" title="Doit commencer par CP suivi de 9 chiffres"/><br><br>

            <label for="adresse">Adresse </label>
            <input type="text" id="adresse" name="adresse" required/><br><br>

            <label for="ville">Ville </label>
            <input type="text" id="ville" name="ville" required/><br><br>

            <label for="cp">Code Postal </label>
            <input type="text" id="cp" name="cp" required 
                pattern="^\d{5}$" 
                title="Le code postal doit contenir exactement 5 chiffres (aucune lettre ou symbole n’est autorisé)" 
                maxlength="5" 
                inputmode="numeric"/>
            <br><br>
            
            <label for="pwd">Mot de passe </label>
            <input type="password" id="pwd" name="pwd" required pattern=".{7}" title="Le mot de passe doit contenir exactement 7 caractères" maxlength="7"/><br><br>

            <input type="submit" value="S'inscrire">
            <input type="reset" value="Annuler">
                    
        </fieldset>
    <br>
    <a href="<?php echo site_url('welcome/contenu/Accueil');?>" class ="button">Retourner à la page d'accueil</a> 
    </form>
</div>
</body>

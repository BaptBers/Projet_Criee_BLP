<body>
    <?php if (isset($_SESSION['is_admin'])) { ?>
        <br><br>
        <div class="produits-container">
        <form action="<?php echo site_url('welcome/validerAjoutLot'); ?>" method="POST" class="formajoutlot">
            <fieldset>
                <legend>Informations du lot</legend>
                
                <label for="IdEspece">Nom commun</label>
                    <select id="IdEspece" name="IdEspece" required style="display: block; width: 100%; margin-bottom: 10px;">
                        <option value="">Sélectionner un nom commun</option>
                        <?php foreach ($nomsCommuns as $commun): ?>
                            <option value="<?php echo $commun['IdEspece']; ?>"><?php echo $commun['nomCommun']; ?></option>
                        <?php endforeach; ?>
                    </select><br>

                <label for="datePeche">Date de pêche</label>
                <input type="date" id="datePeche" name="datePeche" required><br>

                 <label for="IdBateau">Nom du bateau</label>
                    <select id="IdBateau" name="IdBateau" required style="display: block; width: 100%; margin-bottom: 10px;">
                        <option value="">Sélectionner un bateau</option>
                        <br/>
                        <?php foreach ($nomsBateaux as $bateau): ?>
                            <option value="<?php echo $bateau['IdBateau']; ?>"><?php echo $bateau['nomBateau']; ?></option>
                        <?php endforeach; ?>
                    </select><br>

                <label for="dateOuverture">Date d'ouverture</label>
                <input type="date" id="dateOuverture" name="dateOuverture" required><br>
                
                <label for="heureOuverture">Heure d'ouverture</label>
                <input type="time" id="heureOuverture" name="heureOuverture" required><br>

                <label for="dateFermeture">Date de fermeture</label>
                <input type="date" id="dateFermeture" name="dateFermeture" required><br>
                
                <label for="heureFermeture">Heure de fermeture</label>
                <input type="time" id="heureFermeture" name="heureFermeture" required><br>
                
                <label for="prixDepart">Prix de départ (€)</label>
                <input type="number" id="prixDepart" name="prixDepart" step="0.01" required><br>

                <label for="poidsBrut">Poids brut (KG)</label>
                <input type="number" id="PoidsBrut" name="PoidsBrut" step="0.25" required><br>
           
                <label for="IdQualite">Qualité</label>
                    <select id="IdQualite" name="IdQualite" required style="display: block; width: 100%; margin-bottom: 10px;">
                        <option value="">Sélectionner une qualité</option>
                        <?php foreach ($qualites as $qualite): ?>
                            <option value="<?php echo $qualite['IdQualite']; ?>">
                                <?php echo $qualite['descriptionQualite']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>

                <label for="taille">Taille</label>
                    <select id="taille" name="taille" required style="display: block; width: 100%; margin-bottom: 10px;">
                        <option value="">Sélectionner une taille</option>
                        <?php foreach ($tailles as $taille): ?>
                            <option value="<?php echo $taille['IdTaille']; ?>">
                                <?php echo $taille['IdTaille']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>

                <label for="IdBac">Taille du bac</label>
                    <select id="IdBac" name="IdBac" required style="display: block; width: 100%; margin-bottom: 10px;">
                        <option value="">Sélectionner une tare</option>
                        <?php foreach ($tares as $tare): ?>
                            <option value="<?php echo $tare['IdBac']; ?>"> 
                                <?php echo $tare['designationTaille']; ?>  
                            </option>
                        <?php endforeach; ?>
                    </select><br>

                 <label for="IdPresentation">Description</label>
                    <select id="IdPresentation" name="IdPresentation" required style="display: block; width: 100%; margin-bottom: 10px;">
                        <option value="">Sélectionner une description</option>
                        <?php foreach ($descriptionPresentation as $description): ?>
                            <option value="<?php echo $description['IdPresentation']; ?>">
                                <?php echo $description['descriptionPresentation']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>

                    <input type="submit" value="Valider">

            </fieldset>
        </form>
    </div>
    <?php } else { ?>
        <p>Vous devez être admin pour ajouter des lots.</p>
    <?php } ?>
</body>

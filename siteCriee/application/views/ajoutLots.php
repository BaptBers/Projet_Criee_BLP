<body>
    <?php if (isset($_SESSION['is_admin'])) { ?>
        <br><br>
        <div class="produits-container">
        <form action="<?php echo site_url('welcome/validerAjoutLot'); ?>" method="POST" class="formajoutlot">
            <fieldset>
                <legend>Informations du lot</legend>
                
                <!-- <label for="nomScientifique">Nom scientifique</label>
                <input type="text" id="nomScientifique" name="nomScientifique" required><br><br> -->


                <label for="nomScientifique">Nom scientifique</label>
                    <select id="nomScientifique" name="nomScientifique" required style="display: block; width: 100%; margin-bottom: 10px;">
                        <option value="">Sélectionner un nom scientifique</option>
                        <?php foreach ($nomsScientifiques as $scientifique): ?>
                            <option value="<?php echo $scientifique['nomScientifique']; ?>"><?php echo $scientifique['nomScientifique']; ?></option>
                        <?php endforeach; ?>
                    </select><br>


                <!-- <label for="nomCommun">Nom commun</label>
                <input type="text" id="nomCommun" name="nomCommun" required><br><br> -->


                <label for="nomCommun">Nom commun</label>
                    <select id="nomCommun" name="nomCommun" required style="display: block; width: 100%; margin-bottom: 10px;">
                        <option value="">Sélectionner un nom commun</option>
                        <?php foreach ($nomsCommuns as $commun): ?>
                            <option value="<?php echo $commun['nomCommun']; ?>"><?php echo $commun['nomCommun']; ?></option>
                        <?php endforeach; ?>
                    </select><br>


                <label for="datePeche">Date de pêche</label>
                <input type="date" id="datePeche" name="datePeche" required><br>

                <!-- <label for="nomBateau">Nom du bateau</label>
                <input type="text" id="nomBateau" name="nomBateau" required><br><br>
                 -->

                 <label for="nomBateau">Nom du bateau</label>
                    <select id="nomBateau" name="nomBateau" required style="display: block; width: 100%; margin-bottom: 10px;">
                        <option value="">Sélectionner un bateau</option>
                        <br/>
                        <?php foreach ($nomsBateaux as $bateau): ?>
                            <option value="<?php echo $bateau['nomBateau']; ?>"><?php echo $bateau['nomBateau']; ?></option>
                        <?php endforeach; ?>
                    </select><br>


                <label for="dateOuverture">Date d'ouverture</label>
                <input type="date" id="dateOuverture" name="dateOuverture" required><br>
                
                <label for="heureOuverture">Heure d'ouverture</label>
                <input type="time" id="heureOuverture" name="heureOuverture" required><br>
                
                <label for="prixDepart">Prix de départ (€)</label>
                <input type="number" id="prixDepart" name="prixDepart" step="0.01" required><br>

                <label for="poidsBrut">Poids brut (KG)</label>
                <input type="number" id="PoidsBrut" name="PoidsBrut" step="0.25" required><br>

                <label for="poidsBrut">Poids net (KG)</label>
                <input type="number" id="PoidsNet" name="PoidsNet" step="0.25" required><br>


                <label for="qualite">Qualité</label>
                    <select id="qualite" name="qualite" required style="display: block; width: 100%; margin-bottom: 10px;">
                        <option value="">Sélectionner une qualité</option>
                        <?php foreach ($qualites as $qualite): ?>
                            <option value="<?php echo $qualite['descriptionQualite']; ?>">
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

                <label for="tare">Tare</label>
                    <select id="tare" name="tare" required style="display: block; width: 100%; margin-bottom: 10px;">
                        <option value="">Sélectionner une tare</option>
                        <?php foreach ($tares as $tare): ?>
                            <option value="<?php echo $tare['tare']; ?>"> <!-- Utilise 'designationTaille' ici -->
                                <?php echo $tare['tare']; ?>  <!-- Affiche la bonne valeur -->
                            </option>
                        <?php endforeach; ?>
                    </select><br>

                
                <!-- <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required></textarea><br><br>
                 -->


                 <label for="description">Description</label>
                    <select id="description" name="description" required style="display: block; width: 100%; margin-bottom: 10px;">
                        <option value="">Sélectionner une description</option>
                        <?php foreach ($descriptionPresentation as $description): ?>
                            <option value="<?php echo $description['descriptionPresentation']; ?>">
                                <?php echo $description['descriptionPresentation']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>

                

                
                <label for="image">Image du lot</label>
                <input type="file" id="image" name="image" required><br><br>
                
                <input type="submit" value="Ajouter le lot">
            </fieldset>
        </form>
    </div>
    <?php } else { ?>
        <p>Vous devez être admin pour ajouter des lots.</p>
    <?php } ?>
</body>

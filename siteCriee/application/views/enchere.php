<body>
    <br>
    <h2 class="titre">Détails du lot</h2>
    <div class="enchere">
        <?php if (isset($lotDetails)) { ?>
            <!-- Image du lot -->
            <img src="<?= base_url('assets/' . (isset($lotDetails['ImageLot']) ? $lotDetails['ImageLot'] : 'default.jpg')); ?>" alt="Image du Lot">

            <!-- Détails du lot -->
            <div class="enchere-details">
                <!-- Bloc 1 : Numéro de lot, nom scientifique, espèce -->
                <div class="info-group">
                    <p><strong>Numéro du lot :</strong> <?= $lotDetails['IdLot']; ?></p>
                    <p><strong>Nom scientifique :</strong> <?= isset($lotDetails['nomScientifique']) ? $lotDetails['nomScientifique'] : 'Non spécifiée'; ?></p>
                    <p><strong>Espèce :</strong> <?= isset($lotDetails['nomCommun']) ? $lotDetails['nomCommun'] : 'Non spécifiée'; ?></p>
                </div>

                <!-- Bloc 2 : Nom du bateau et date de pêche -->
                <div class="info-group">
                    <p><strong>Nom du bateau :</strong> <?= isset($lotDetails['nomBateau']) ? $lotDetails['nomBateau'] : 'Non spécifié'; ?></p>
                    <p><strong>Date de pêche :</strong> <span id="date"><?= isset($lotDetails['datePeche']) ? $lotDetails['datePeche'] : 'Non spécifiée'; ?></span></p>
                </div>

                <!-- Bloc 3 : Taille, qualité et description -->
                <div class="info-group">
                    <p><strong>Taille :</strong> <?= isset($lotDetails['descriptionTaille']) ? $lotDetails['descriptionTaille'] : 'Non spécifiée'; ?></p>
                    <p><strong>Qualité :</strong> <?= isset($lotDetails['descriptionQualite']) ? $lotDetails['descriptionQualite'] : 'Non spécifiée'; ?></p>
                    <p><strong>Description :</strong> <?= isset($lotDetails['descriptionPresentation']) ? $lotDetails['descriptionPresentation'] : 'Description non disponible'; ?></p>
                </div>

                <!-- Bloc 4 : Poids brut et prix -->
                <div class="info-group">
                    <p><strong>Poids brut du lot :</strong> <?= isset($lotDetails['poidsBrutLot']) ? $lotDetails['poidsBrutLot'] . ' kg' : 'Non spécifié'; ?></p>
                    <p><strong>Prix de départ :</strong> <?= isset($lotDetails['prixDepart']) ? $lotDetails['prixDepart'] : 'Prix non disponible'; ?> €</p>
                    <p><strong>Prix d'enchère actuelle :</strong> <span id="prix"> <?= isset($lotDetails['prixEnchereActuelle']) ? $lotDetails['prixEnchereActuelle'] : 'Prix non disponible'; ?> € </span></p>
                </div>

                <!-- Bloc 5 : Temps restant -->
                <?php
                $dateFin = $lotDetails['dateFin'] . ' ' . $lotDetails['heureFin'];
                ?>
                <div class="info-group">
                    <p><strong>Temps restant :</strong> <span id="timer"></span></p>
                    <!-- Formulaire d'enchère -->
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <div class="enchere-form">
                            <form method="POST" action="<?= site_url('welcome/placerEnchere'); ?>">
                            <label for="montantEnchere">Votre enchère : </label>
                            <input type="number" id="montantEnchere" name="montantEnchere" step="0.01" min="<?= isset($lotDetails['prixEnchereActuelle']) + 1 ? $lotDetails['prixEnchereActuelle'] : 0 ?>" placeholder="Entrez votre enchère" required>
                            <input type="hidden" name="IdLot" value="<?= $lotDetails['IdLot']; ?>">
                            <button type="submit" class="button">Placer l'enchère</button>
                            </form>
                        </div>
                    <?php } else { ?>
                        <p>Vous devez être connecté pour enchérir sur ce lot.</p>
                    <?php } ?>
                </div>
            </div>
        <?php } else { ?>
            <p>Aucun détail trouvé pour ce lot.</p>
        <?php } ?>
    </div>

    <div class="bouton-retour">
        <a href="<?php echo site_url('welcome/contenu/EncheresEnCours'); ?>" class="buttonRetour">Retour</a>
    </div>

    <script>
        // Passer la date de fin au JavaScript
        var endDate = new Date("<?= isset($dateFin) ? $dateFin : ''; ?>");

        function updateTimer() {
            var currentDate = new Date();
            var tempsRestant = endDate - currentDate;

            if (tempsRestant <= 0) {
                document.getElementById("timer").innerHTML = "L'enchère est terminée";
                clearInterval(timerInterval);
                return;
            }

            // Convertir le temps restant en unités
            var heures = Math.floor(tempsRestant / (1000 * 60 * 60)); // Convertir tout en heures
            var minutes = Math.floor((tempsRestant % (1000 * 60 * 60)) / (1000 * 60)); // Minutes restantes
            var secondes = Math.floor((tempsRestant % (1000 * 60)) / 1000); // Secondes restantes

            // Mettre à jour l'affichage
            document.getElementById("timer").innerHTML = heures + ":" + minutes + ":" + secondes;
        }

        // Mettre à jour le chronomètre toutes les secondes
        var timerInterval = setInterval(updateTimer, 1000);
        updateTimer();
    </script>
</body>

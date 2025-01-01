<body>
    <h1>Détails du Lot</h1>
    <div class="enchere">
        <?php if (isset($lotDetails)) { ?>
            <img src="<?= base_url('assets/' . (isset($lotDetails['ImageLot']) ? $lotDetails['ImageLot'] : 'default.jpg')); ?>" alt="Image du Lot">
        <p>Numéro du lot : <?= $lotDetails['IdLot']; ?></p>
        <p>Description : <?= isset($lotDetails['description']) ? $lotDetails['description'] : 'Description non disponible'; ?></p>
        <p>Prix Initial : <?= isset($lotDetails['prixDepart']) ? $lotDetails['prixDepart'] : 'Prix non disponible'; ?> €</p>
        <?php } else { ?>
            <p>Aucun détail trouvé pour ce lot.</p>
        <?php } ?>
    </div>
    <div class="bouton-retour">
        <a href="<?php echo site_url('welcome/contenu/EncheresEnCours'); ?>" class="button">Retour</a>
    </div>

</body>
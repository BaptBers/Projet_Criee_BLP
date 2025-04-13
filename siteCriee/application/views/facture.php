<body>
<br>
<?php if (!empty($factures) && !isset($_SESSION['is_admin'])): ?>
    <?php foreach ($factures as $facture): ?>
        <div class="mentions-legales">
            <h3><span id="factureId">FACTURE</span></h3>
            <hr>
            <p><strong>Heure de la commande :</strong> <?= date('H:i:s', strtotime($facture['heureCommande'])) ?></p>
            <p><strong>Date de la commande :</strong> <span id="date"><?= date('Y-m-d', strtotime($facture['dateCommande'])) ?></span></p>
            <p><strong>Montant total :</strong> <span id="prix"><?= number_format($facture['montantTotal'], 2, '.', ' ') ?> €</span></p>
            <hr>
            <h4>Détails de la commande :</h4>
            <hr>
            <ul>
                <?php foreach ($facture['details'] as $detail): ?>
                    <li>
                        <p><span id="factureId"><strong>Lot N° <?= $detail['IdLot'] ?></strong></span></p>
                        <p>Espèce : <?= $detail['nomCommun'] ?> (<?= $detail['nomScientifique'] ?>)</p>
                        <p><strong>Date de pêche :</strong> <span id="date"><?= $detail['datePeche'] ?></span></p>
                        <p>Nom du bateau : <?= $detail['nomBateau'] ?></p>
                        <p>Poids brut : <?= $detail['poidsBrutLot'] ?> kg</p>
                        <p><strong>Montant de l'enchère :</strong> <span id="prix"><?= number_format($detail['montant'], 2, '.', ' ') ?> €</span></p>
                        <hr>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <br>
    <?php endforeach; ?>
<?php else: ?>
    <div class="resultat">
        <p id="empty"><strong>Vous n'avez pas encore de factures.</strong></p>
    </div>
<?php endif; ?>

<div class="bouton-retour">
    <a href="<?= site_url('welcome/contenu/Accueil'); ?>" class="buttonRetour">Retourner à la page d'accueil</a>
</div>
</body>

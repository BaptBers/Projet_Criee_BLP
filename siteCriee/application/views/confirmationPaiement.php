<body class="accueil">
    <br><br>
    <h3>Votre paiement a été validé</h3>
    
    <div class="resume-commande">
        <p><strong>Heure de la commande :</strong> <?= $heureCommande ?></p>
        <p><strong>Date de la commande :</strong> <?= $dateCommande ?></p>
        <p><strong>Montant total :</strong> <?= number_format($facture['montantTotal'], 2, '.', ' ') ?> €</p>

        <h4>Détails de la commande :</h4>
        <ul>
            <?php foreach ($factureDetails as $detail): ?>
                <li>
                    <strong>Lot N° <?= $detail['IdLot'] ?> :</strong>
                    Montant de l'enchère : <?= number_format($detail['montant'], 2, '.', ' ') ?> €
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <br><br>
    <a href="<?= site_url('welcome/contenu/Accueil') ?>">Retour à l'accueil</a>
</body>
</html>

<body>
    <div class="container-panier">
        <h1 class="panier-header">MON PANIER</h1>

        <?php if (isset($panier) && !empty($panier)): ?>
            <!-- Si le panier contient des éléments -->
            <div>
                <?php
                    foreach ($panier as $row) {
                        echo "<form>";
                        echo "<div class='lot'>";
                        echo "<p><strong>N° lot :</strong> " . $row['IdLot'] . "</p>";
                        echo "<p><strong>Montant de l'enchère :</strong> " . $row['montantEnchere'] . " €</p>";
                        echo "</div>";
                        echo "</form>";
                    }
                ?>
            </div>

            <!-- Affichage du total -->
            <?php if (isset($total)): ?>
                <div class="total">
                    <p>Total du panier : <span><?= number_format($total, 2, '.', ' ') ?> €</span></p>
                </div>
            <?php endif; ?>

			<!-- Bouton de paiement -->
			<div class="payment-button-container">
                <form action="<?= site_url('welcome/insererFacture') ?>" method="post">
                    <!-- Montant total -->
                    <input type="hidden" name="montantTotal" value="<?= $total ?>">

                    <!-- Chaque lot dans le panier -->
                    <?php foreach ($panier as $row): ?>
                        <input type="hidden" name="idLot[]" value="<?= $row['IdLot'] ?>">
                    <?php endforeach; ?>

                    <button type="submit" class="btn-payer">Payer</button>
                </form>
            </div>
            
        <?php else: ?>
            <!-- Si le panier est vide -->
            <div class="empty-panier">
                <p>Votre panier est vide. Remportez des lots dans les enchères en cours pour continuer.</p>
            </div>
        <?php endif; ?>
    </div>
    <div class="bouton-retour">
			<a href="<?php echo site_url('welcome/contenu/Facture');?>" class="buttonRetour">Voir mes factures</a>
	</div>        
</body>

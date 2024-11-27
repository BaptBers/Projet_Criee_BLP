<body>
	<?php
	// Affichage du nom et prénom 
	foreach ($conn as $row) {
		$user_prenom = $row['nom'];
		$user_nom = $row['prenom'];
	}
	?>
    <h2>Bienvenue sur la page de commande</h2>
    <p>Bonjour, <?php echo htmlspecialchars($user_prenom . ' ' . $user_nom); ?> !</p>

    <?php echo validation_errors(); ?>
	<form action="<?php echo site_url('welcome/validerCommande'); ?>" method='POST' class="">
        <fieldset>
            <legend><h2>Produits</h2></legend>
            <div class="produits-container">

            <div class="produits">
                <h2>Pains</h2>
                <p>Baguette traditionnelle <input type="number" name="quantite_baguette" min="0" placeholder="Quantité"></p>
                <p>Pain de campagne <input type="number" name="quantite_campagne" min="0" placeholder="Quantité"></p>
                <p>Pain aux céréales <input type="number" name="quantite_cereales" min="0" placeholder="Quantité"></p>
            </div>

            <div class="produits">
                <h2>Viennoiseries</h2>
                <p>Croissant pur beurre <input type="number" name="quantite_croissant" min="0" placeholder="Quantité"></p>
                <p>Pain au chocolat <input type="number" name="quantite_chocolat" min="0" placeholder="Quantité"></p>
                <p>Chausson aux pommes <input type="number" name="quantite_chausson" min="0" placeholder="Quantité"></p>
            </div>

            <div class="produits">
                <h2>Spécialités</h2>
                <p>Fougasse aux olives <input type="number" name="quantite_fougasse" min="0" placeholder="Quantité"></p>
                <p>Pain d'épices <input type="number" name="quantite_epices" min="0" placeholder="Quantité"></p>
                <p>Galette frangipane <input type="number" name="quantite_galette" min="0" placeholder="Quantité"></p>
            </div>

            </div>
            <input type="submit" value="Valider la commande">
        </fieldset>
    </form>
    
    <a href="<?php echo site_url('welcome/contenu/affichage');?>"><input type="button" value="Retourner à la page d'accueil"></a>
</body>

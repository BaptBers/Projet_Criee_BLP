<body>
		<p>Voici les futures enchères</p>
		<div class="produits-container">
			<?php
			foreach ($labelFuturesEncheres as $row) {
				echo "<form class = 'produits'>";
				echo "<div>";
				echo "<p>N° lot :" . $row['IdLot'] . "</p>";
				echo "<img src='" .base_url()."/assets/". $row['ImageLot'] . "' alt=''>";
				echo "<p>Date d'ouverture du lot : " . $row['dateOuverture'] . "</p>";
				echo "<p>Heure d'ouverture du lot : " . $row['heureOuverture'] . "</p>";
				echo "<p>Description : " . $row['nomCommun'] . "</p>";
				echo "</div>";
				echo "</form>";
			}
			?>
		</div>

		<div class="bouton-retour">
			<a href="<?php echo site_url('welcome/contenu/affichage');?>" class="button">Retourner à la page d'accueil</a>
		</div>

	</body>
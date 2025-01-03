<body>
	<br><br>
		<div class="produits-container">
			<?php
			foreach ($labelFuturesEncheres as $row) {
				echo "<form class = 'produits'>";
				echo "<div>";
				echo "<h3>N° lot : " . $row['IdLot'] . "</h3>";
				echo "<img src='" .base_url()."/assets/". $row['ImageLot'] . "' alt=''>";
				echo "<p>Date d'ouverture du lot : <span id='date'>" . $row['dateOuverture'] . "</span></p>";
				echo "<p>Heure d'ouverture du lot : " . $row['heureOuverture'] . "</p>";
				echo "<p>Description : " . $row['nomCommun'] . "</p>";
				echo "</div>";
				echo "</form>";
			}
			?>
		</div>

		<div class="bouton-retour">
			<a href="<?php echo site_url('welcome/contenu/Accueil');?>" class="buttonRetour">Retourner à la page d'accueil</a>
		</div>

	</body>
<body>
		<p>Page de Futures encheres</p>
		<div class="produits-container">
			<?php
			foreach ($labelFuturesEncheres as $row) {
				echo "<form class = 'produits'>";
				echo "<div>";
				echo "<p>N° lot :" . $row['IdLot'] . "</p>";
				echo "<img src='" .base_url()."/assets/". $row['ImageLot'] . "' alt=''>";
				echo "<p>Date d'ouverture du lot : " . $row['dateEnchere'] . "</p>";
				echo "<p>Heure d'ouverture du lot : " . $row['heureDebutEnchere'] . "</p>";
				echo "<p>Description : " . $row['description'] . "</p>";
				echo "</div>";
				echo "</form>";
			}
			?>
		</div>

		<a href="<?php echo site_url('welcome/contenu/affichage');?>" class ="button">Retourner à la page d'accueil</a>     

	</body>
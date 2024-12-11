	<body>
		<p>Page de Encheres en cours</p>

		<div class="produits-container">
			<?php
			foreach ($labelEncheresEnCours as $row) {
				echo "<form class = 'produits'>";
				echo "<div>";
				echo "<img src='" .base_url()."/assets/". $row['ImageLot'] . "' alt=''>";
				echo "<p>N° lot :" . $row['IdLot'] . "</p>";
				echo "</div>";
				echo "</form>";
			}
			?>
		</div>




		<a href="<?php echo site_url('welcome/contenu/affichage');?>" class ="button">Retourner à la page d'accueil</a>     

	</body>
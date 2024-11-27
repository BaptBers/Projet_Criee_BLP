	<body>
	
		<div class="produits-container">
			<?php
			// Affichage des pains 
			foreach ($labeldatapains as $row) {
				echo "<form class = 'produits'>";
				echo "<div>";
				//$photoprod = base_url()."/assets/";
				echo "<img src='" .base_url()."/assets/". $row['photoProduit'] . "' alt=''>";
				echo "<h2>" . $row['designationProduit'] . "</h2>";
				echo "<p>" . $row['descriptionProduit'] . "</p>";
				echo "<p>Prix: " . $row['prixProduit'] . " €</p>";
				echo "<p>Poids: " . $row['poidsProduit'] . " g</p>";
				echo "</div>";
				echo "</form>";
			}
			?>
		</div>
		<a href="<?php echo site_url('welcome/contenu/affichage');?>"><input type="button" value="Retourner à la page d'accueil"></a>
    

	</body>
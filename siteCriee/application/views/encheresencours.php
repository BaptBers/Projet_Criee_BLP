	<body>
		<p>Voici les enchères en cours</p>
		
    <div class="produits-container">
        <?php
        foreach ($labelEncheresEnCours as $row) {
			echo "<form method='POST' action='". site_url('welcome/contenu/EnchereOuverte') ."' class='produits'>";
            echo "<div>";
            echo "<p>N° lot : " . $row['IdLot'] . "</p>";
            echo "<img src='" . base_url() . "/assets/" . $row['ImageLot'] . "' alt='Image du Lot'>";
            echo "<br><br>";
            // Champ caché pour envoyer l'ID du lot
            echo "<input type='hidden' name='idLot' value='" . $row['IdLot'] . "'>";
            echo "<button type='submit' class='button'>ENCHERIR</button>";
            echo "</div>";
			echo "</form>";
        }
        ?>
    </div>
</body>
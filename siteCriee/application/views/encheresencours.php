<body>
    <p>Voici les enchères en cours</p>
    <div class="produits-container">
        <?php
        foreach ($labelEncheresEnCours as $row) {
            echo "<form method='POST' action='" . site_url('welcome/contenu/EnchereOuverte') . "' class='produits'>";
            echo "<div>";
            echo "<p>N° lot : " . $row['IdLot'] . "</p>";
            echo "<img src='" . base_url() . "/assets/" . $row['ImageLot'] . "' alt='Image du Lot'>";
            echo "<br><br>";
            echo "<p id='timer" . $row['IdLot'] . "'>Calcul en cours...</p>"; // Zone pour le chronomètre

            // Passer la date et l'heure de fin dans un attribut data
            echo "<input type='hidden' name='idLot' value='" . $row['IdLot'] . "'>";
            echo "<button type='submit' class='button'>ENCHERIR</button>";
            echo "</div>";
            echo "</form>";

            // Ajouter un script pour gérer chaque chronomètre
            echo "<script>
                var endDate" . $row['IdLot'] . " = new Date('" . $row['dateFin'] . " " . $row['heureFin'] . "');
                function updateTimer" . $row['IdLot'] . "() {
                    var currentDate = new Date();
                    var timeLeft = endDate" . $row['IdLot'] . " - currentDate;

                    if (timeLeft <= 0) {
                        document.getElementById('timer" . $row['IdLot'] . "').innerHTML = 'L\\'enchère est terminée';
                        clearInterval(timerInterval" . $row['IdLot'] . ");
                        return;
                    }

                    var totalHours = Math.floor(timeLeft / (1000 * 60 * 60)); // Convertir tout en heures
                    var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60)); // Minutes restantes
                    var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000); // Secondes restantes

                    document.getElementById('timer" . $row['IdLot'] . "').innerHTML = 'Temps restant : ' + totalHours + ' heures ' + minutes + ' minutes ' + seconds + ' secondes';
                }

                var timerInterval" . $row['IdLot'] . " = setInterval(updateTimer" . $row['IdLot'] . ", 1000);
                updateTimer" . $row['IdLot'] . "();
            </script>";
        }
        ?>
    </div>

    <div class="bouton-retour">
			<a href="<?php echo site_url('welcome/contenu/affichage');?>" class="button">Retourner à la page d'accueil</a>
	</div>
</body>

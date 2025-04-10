<body>
    <br>
    <br>
    <div class="accueil-container">
        <!-- Colonne gauche : Actualités pêche -->
        <div class="bloc-actualites">
            <h2>📰 Actualités pêche</h2>
            <br>
            <?php
                $rss = simplexml_load_file('https://www.peche-poissons.com/rss.xml');
                if ($rss) {
                    echo "<ul>";
                    $count = 0;
                    foreach ($rss->channel->item as $item) {
                        echo "<li><a href='{$item->link}' target='_blank'>{$item->title}</a></li>";
                        if (++$count >= 6) break;
                    }
                    echo "</ul>";
                } else {
                    echo "<p>Impossible de charger les actualités.</p>";
                }
            ?>
        </div>

        <!-- Colonne centrale : description du site -->
        <div class="bloc-description">
            <h2>⚓ Qui sommes-nous ?</h2>
            <p>
                La criée de Cornouailles regroupe plus de 50 pêcheurs artisans engagés dans une pêche responsable et durable. 
                Notre mission : garantir la fraîcheur, la transparence et la traçabilité des produits de la mer.
                Tous nos produits sont issus de la pêche locale et contrôlés à la source.
            </p>
            <h2>🌊 Ce que nous proposons</h2>
            <p>
                En tant qu’acheteur professionnel, accédez à une plateforme pour enchérir sur des produits de l'océan Atlantique.
                Visualisez les lots, enchérissez en direct, gérez vos achats et vos comandes, directement depuis notre site web. 
            </p>
            <h2>🏗️ Nos infrastructures</h2>
            <p>
                Notre site de Plouhinec est équipé de salles de criée modernes permettant un déroulement fluide et rapide des ventes.
                Les arrivages des pêcheurs ont lieu quotidiennement dans notre port dédié, garantissant fraîcheur et traçabilité.
                Nous disposons également de salles de pesée précises et conformes aux normes, assurant un enregistrement rigoureux des lots.
                L’ensemble des infrastructures est conçu pour assurer qualité, hygiène, et rapidité du traitement des produits de la mer.
            </p>
        </div>

        <!-- Colonne droite : autres actualités -->
        <div class="bloc-actualites">
            <h2>🌐 Actualités Ouest-France</h2>
            <br>
            <?php
                $rss2 = simplexml_load_file('https://www.ouest-france.fr/rss/france');
                if ($rss2) {
                    echo "<ul>";
                    $count = 0;
                    foreach ($rss2->channel->item as $item) {
                        echo "<li><a href='{$item->link}' target='_blank'>{$item->title}</a></li>";
                        if (++$count >= 6) break;
                    }
                    echo "</ul>";
                } else {
                    echo "<p>Impossible de charger les actualités.</p>";
                }
            ?>
        </div>
    </div>
    <br>
    <br>
</body>

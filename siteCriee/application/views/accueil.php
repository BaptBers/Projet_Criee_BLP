<body>
    <br>
    <br>
    <div class="accueil-container">
        <!-- Colonne gauche : Actualités pêche -->
        <div class="bloc-actualites">
            <h2>📰 Actualités pêche monde</h2>
            <br>
            <br>
            <?php
                $rss = simplexml_load_file('https://onthewater.com/feed/');
                if ($rss) {
                    echo "<ul>";
                    echo "<hr>";
                    $count = 0;
                    foreach ($rss->channel->item as $item) {
                        echo "<li><a href='{$item->link}' target='_blank'>{$item->title}</a></li>";
                        echo "<hr style='background-color:#0c4782'>";
                        if (++$count >= 8) break;
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
                La criée de Cornouailles regroupe plus de <strong>50 pêcheurs artisans</strong> engagés dans une pêche responsable et durable. 
                Notre mission : garantir la fraîcheur, la transparence et la traçabilité des produits de la mer.
                <strong>Tous nos produits sont issus de la pêche locale et contrôlés à la source.</strong>
            </p>
            <h2>🌊 Ce que nous proposons</h2>
            <p>
                En tant qu’<strong>acheteur professionnel</strong>, accédez à une plateforme pour enchérir sur des produits de l'océan Atlantique.
                Visualisez les lots, enchérissez en direct, gérez vos achats et vos comandes, directement depuis notre site web. 
            </p>
            <h2>🏗️ Nos infrastructures</h2>
            <p>
                Notre site de <strong>Plouhinec</strong> est équipé de salles de criée modernes permettant un déroulement fluide et rapide des ventes.
                Les arrivages des pêcheurs ont lieu <strong>quotidiennement</strong> dans notre port dédié, garantissant <strong>fraîcheur et traçabilité</strong>.
                Nous disposons également de salles de pesée précises et conformes aux normes, assurant un enregistrement rigoureux des lots.
                L’ensemble des infrastructures est conçu pour assurer <strong>qualité, hygiène et rapidité</strong> du traitement des produits.
            </p>
            <p><strong>Venez nous rendre visite !</strong></p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d144493.54013958978!2d-3.2058071055326747!3d47.70603800891145!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4810688d21f80265%3A0x3262abaa0f3ff310!2s1%20Quai%20de%20Larmor%2C%2056680%20Plouhinec!5e0!3m2!1sfr!2sfr!4v1745009840652!5m2!1sfr!2sfr" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <p><strong>Adresse :</strong> 1 Quai de Larmor, Plouhinec 56680</p>
        </div>

        <!-- Colonne droite : autres actualités -->
        <div class="bloc-actualites">
            <h2>🌐 Actualités Ouest-France</h2>
            <br>
            <br>
            <?php
                $rss2 = simplexml_load_file('https://www.ouest-france.fr/rss/france');
                if ($rss2) {
                    echo "<ul>";
                    echo "<hr>";
                    $count = 0;
                    foreach ($rss2->channel->item as $item) {
                        echo "<li><a href='{$item->link}' target='_blank'>{$item->title}</a></li>";
                        echo "<hr>";
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

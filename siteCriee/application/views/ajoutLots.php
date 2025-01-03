<body>
    <?php if (isset($_SESSION['is_admin'])) { ?>
        <br><br>
        <div class="produits-container">
        <form action="<?php echo site_url('admin/ajouterLot'); ?>" method="POST" enctype="multipart/form-data" class="form-ajout-lot">
            <fieldset>
                <legend>Informations du lot</legend>
                
                <label for="nomLot">Nom du lot</label>
                <input type="text" id="nomLot" name="nomLot" required><br><br>
                
                <label for="dateOuverture">Date d'ouverture</label>
                <input type="date" id="dateOuverture" name="dateOuverture" required><br><br>
                
                <label for="heureOuverture">Heure d'ouverture</label>
                <input type="time" id="heureOuverture" name="heureOuverture" required><br><br>
                
                <label for="prixDepart">Prix de départ (€)</label>
                <input type="number" id="prixDepart" name="prixDepart" step="0.01" required><br><br>
                
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required></textarea><br><br>
                
                <label for="image">Image du lot</label>
                <input type="file" id="image" name="image" required><br><br>
                
                <input type="submit" value="Ajouter le lot">
            </fieldset>
        </form>
    </div>
    <?php } else { ?>
        <p>Vous devez être admin pour ajouter des lots.</p>
    <?php } ?>
</body>

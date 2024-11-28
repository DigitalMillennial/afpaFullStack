<?php 
include 'header.php';
include 'connection.php'; 
include 'demande.php'; 
?>

<link rel="stylesheet" href="/src/style_form.css"> 

<div id="page-wrapper">
    
    <section id="add-dish-section">
        <div class="form-container">
            <h3 class="text-center mb-4">Ajouter un nouveau plat</h3>
            <form method="POST" action="add_script.php" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="libelle">Nom du plat</label>
                    <input type="text" name="libelle" class="form-control" id="libelle" placeholder="Entrez le nom du plat" required>
                </div>

               
                <div class="form-group">
                    <label for="id_categorie">Catégorie</label>
                    <select name="id_categorie" class="form-control" id="id_categorie" required>
                        <?php
                        $categories = $record->query("SELECT id, libelle FROM categorie");
                        foreach ($categories as $category) {
                            echo "<option value=\"{$category['id']}\">{$category['libelle']}</option>";
                        }
                        ?>
                    </select>
                </div>

                
                <div class="form-group">
                    <label for="prix">Prix (€)</label>
                    <input type="number" step="0.01" name="prix" class="form-control" id="prix" placeholder="Entrez le prix" required>
                </div>

                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description" rows="3" placeholder="Entrez une description" required></textarea>
                </div>

                <!-- Изображение -->
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control-file" id="image" required>
                </div>

                <!-- Статус активации -->
                <div class="form-group">
                    <label for="active">Active</label>
                    <select name="active" class="form-control" id="active" required>
                        <option value="Yes">Oui</option>
                        <option value="No">Non</option>
                    </select>
                </div>

                
                <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
                <a href="plats.php" class="btn btn-secondary btn-block">Retour</a>
            </form>
        </div>
    </section>

    
    <?php include 'footer.php'; ?>
</div>

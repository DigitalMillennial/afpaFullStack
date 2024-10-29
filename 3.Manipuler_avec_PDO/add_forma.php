<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>LISTE</title>  
  <meta name="robots" content="index, follow">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Подключение Bootstrap и Font Awesome для иконок -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
try {
    $record = new PDO('mysql:host=localhost;dbname=record;charset=utf8', 'root', 'root');
    $record->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
?>
<div class="container mt-5">
    <h3 style="font-weight: bold;">Ajouter un disque</h3>
    <form method="POST" action="add_script.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Entrez le titre" required>
        </div>
        <div class="form-group">
            <label for="artist_id">Artiste</label>
            <select name="artist_id" class="form-control" id="artist_id" required>
                <?php
                // Запрос для получения артистов из таблицы artist
                $artistsQuery = $record->query("SELECT artist_id, artist_name FROM artist");
                foreach ($artistsQuery as $artist) {
                    echo "<option value=\"{$artist['artist_id']}\">{$artist['artist_name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="year">Année</label>
            <input type="number" name="year" class="form-control" id="year" placeholder="Entrez l'année" required>
        </div>
        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" name="genre" class="form-control" id="genre" placeholder="Entrez le genre" required>
        </div>        
        <div class="form-group">
            <label for="label">Label</label>
            <input type="text" name="label" class="form-control" id="label" placeholder="Entrez le label" required>
        </div>
        
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" name="price" class="form-control" id="price" placeholder="Entrez le prix" required>
        </div>
        <div class="form-group">
                <label for="picture">Picture</label>
                <input type="file" name="picture" class="form-control-file" id="picture" required>
            </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="liste_des_disques.php" class="btn btn-secondary">Retour</a>
        </form>
    </div>

    <!-- Подключение JavaScript для Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

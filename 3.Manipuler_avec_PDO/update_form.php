<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Modifier</title>
  <meta name="robots" content="index, follow">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Подключение Bootstrap и Font Awesome для иконок -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
session_start();
try {
    $record = new PDO('mysql:host=localhost;dbname=record;charset=utf8', 'root', 'root');
    $record->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}

if (isset($_GET["disc_id"])) {
    $requete = $record->prepare("SELECT d.disc_picture, d.disc_id, d.disc_title, d.disc_year, d.disc_label, d.disc_genre, d.disc_price, a.artist_name FROM disc d LEFT JOIN artist a ON d.artist_id = a.artist_id WHERE disc_id=?");
    $requete->execute(array($_GET["disc_id"]));
    $disc = $requete->fetch(PDO::FETCH_OBJ);
}
?>
<div class="container mt-5">
    <h3 style="font-weight: bold;">Modifier un vinyle</h3>
    <form method="POST" action="update_script.php" enctype="multipart/form-data">
        <input type="hidden" name="disc_id" value="<?php echo $disc->disc_id; ?>">
        <div class="form-group">
            <label for="title">Titre</label>
            <input type="text" name="title" class="form-control" value="<?= $disc->disc_title ?>" id="title" placeholder="Entrez le titre" required>
        </div>
        <div class="form-group">
            <label for="artist_id">Artiste</label>
            <input type="text" name="artist_id" class="form-control" value="<?= $disc->artist_name ?>" id="artist_id" required>
        </div>
        <div class="form-group">
            <label for="year">Year</label>
            <input type="text" name="year" class="form-control" value="<?= $disc->disc_year ?>" id="year" placeholder="Entrez l'année" required>
        </div>
        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" name="genre" class="form-control" value="<?= $disc->disc_genre ?>" id="genre" placeholder="Entrez le genre" required>
        </div>
        <div class="form-group">
            <label for="label">Label</label>
            <input type="text" name="label" class="form-control" value="<?= $disc->disc_label ?>" id="label" placeholder="Entrez le label" required>
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" name="price" class="form-control" value="<?= $disc->disc_price ?>" id="price" placeholder="Entrez le prix" required>
        </div>
        <div class="form-group">
            <label for="picture">Picture</label>
            <input type="file" name="picture" class="form-control-file" id="picture">
            <div class="d-flex align-items-start flex-column mb-3"><img src="/pictures/<?= $disc->disc_picture ?>" alt="picture" style="width: 150px; height: 150px;"></div>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
        <a href="liste_des_disques.php" class="btn btn-secondary">Retour</a>
    </form>
</div>
<!-- Подключение JavaScript для Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

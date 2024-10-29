<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Restaurant | Meilleurs plats et saveurs délicieuses</title>
  <meta name="description" content="Bienvenue dans notre restaurant! Découvrez nos plats délicieux et savourez le meilleur.">
  <meta name="keywords" content="restaurant, plats, catégorie, nourriture, gastronomie, repas, accueil">
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

    // Подготовка запроса
    $requete = $record->prepare("
        SELECT 
            d.disc_picture, 
            d.disc_title, 
            a.artist_name, 
            d.disc_label, 
            d.disc_year, 
            d.disc_genre,
            d.disc_id 
        FROM 
            disc d
        JOIN 
            artist a ON d.artist_id = a.artist_id
    ");
    $requete->execute();
    
    // Получение результатов
    $discs = $requete->fetchAll(PDO::FETCH_OBJ);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "<br>";
    die("Fin du script");
}
?>

<div class="container mt-5">
    <div class="col-12 mb-3">
        <div class="row  justify-content-between align-items-center">
            <h3 style="font-weight: bold;">Liste des disques(15)</h3>
            <button type="button" class="btn btn-primary" onclick="window.location.href='add_forma.php'">Ajouter</button>
        </div>
    </div>

    <div class="row">    
        <?php foreach ($discs as $disc): ?>
            <div class="col-md-6 d-flex mb-3">
                <div class="me-3" style="flex-shrink: 0;">
                    <img src="pictures/<?=$disc->disc_picture?>" alt="<?=$disc->disc_title?>" class="img-fluid" style="max-width: 150px; height: auto;">
                </div>
                <div class="card-body d-flex flex-column pt-0 pb-0 mb-0">
                    <h5 class="card-title mb-0" style="font-weight: bold;"><?=$disc->disc_title?></h5>
                    <p class="card-text mb-0">Artiste: <?=$disc->artist_name?></p>
                    <p class="card-text mb-0">Label: <?=$disc->disc_label?></p>
                    <p class="card-text ">Année: <?=$disc->disc_year?></p> 
                    <div class="d-flex justify-content-start align-items-center mt-2">
                        <span></span> <!-- Пустое пространство, которое создаст отступ -->
                        <a href="Details.php?disc_id=<?=$disc->disc_id?>" class="btn btn-primary btn-sm" style="border-radius: 5px;">Détails</a>
                    </div>                   
                </div>                
            </div>
        <?php endforeach; ?>
    </div>
</div>



<!-- Подключение скриптов Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

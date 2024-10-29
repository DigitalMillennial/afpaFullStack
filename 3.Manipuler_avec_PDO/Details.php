<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>DETAILS</title>  
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
    $requete = $record->prepare("SELECT d.disc_picture,d.disc_id,d.disc_title,d.disc_year,d.disc_label,d.disc_genre,d.disc_price,a.artist_name from disc d LEFT JOIN artist a ON d.artist_id = a.artist_id where disc_id=?");
    $requete->execute(array($_GET["disc_id"]));
    $disc = $requete->fetch(PDO::FETCH_OBJ);

?>
    <div class="container mt-5">
        <h3 style="font-weight: bold;">Details</h3>

        <form enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <!-- Первый столбец -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input  type="text" name="title" class="form-control" value="<?=$disc->disc_title?>" id="title" placeholder="Entrez le titre" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="text" name="year" class="form-control" value="<?=$disc->disc_year?>" id="year" placeholder="Entrez l'année" required>
                    </div>
                    <div class="form-group">
                        <label for="label">Label</label>
                        <input type="text" name="label" class="form-control" value="<?=$disc->disc_label?>" id="label" placeholder="Entrez le label" required>
                    </div>
                </div>
                <!-- Второй столбец -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="artist_id">Artiste</label>
                        <input type="text" name="artist_id" class="form-control" value="<?=$disc->artist_name?>" id="artist_id" required>                           
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <input type="text" name="genre" class="form-control" value="<?=$disc->disc_genre?>" id="genre" placeholder="Entrez le genre" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Prix</label>
                        <input type="number" name="price" class="form-control" value="<?=$disc->disc_price?>" id="price" placeholder="Entrez le prix" required>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="d-flex align-items-start flex-column mb-3" ><label for="genre">Picture</label></div>
                <div class="d-flex align-items-start flex-column mb-3" ><img src="/pictures/<?=$disc->disc_picture?>" alt="picture" style="width: 300px; height: 300px;"></div>
                </div>
            </div>
            
        </div>        
        </form>        
        <button onclick="window.location.href='update_form.php?disc_id=<?=$disc->disc_id?>'" class="btn btn-primary ml-3">Modifier</button>
        <button onclick="window.location.href='Details_script.php?disc_id=<?=$disc->disc_id?>'" class="btn btn-secondary ml-3">Supprimer</button>
        <a href="liste_des_disques.php" class="btn btn-secondary ml-3">Retour</a>
    </div>
       

    </div>    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

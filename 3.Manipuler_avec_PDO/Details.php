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
// Включение отображения ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $record = new PDO('mysql:host=localhost;dbname=record;charset=utf8', 'root', 'root');
    $record->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получаем данные для заполнения формы
    $artist_id = isset($_GET['artist_id']) ? $_GET['artist_id'] : null;

    if ($artist_id) {
        // Запрос данных артиста
        $stmt = $record->prepare("SELECT * FROM artists WHERE id = :id");
        $stmt->bindParam(':id', $artist_id);
        $stmt->execute();
        $artist = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
}

?>

<div class="container">
    <h1>Детали исполнителя</h1>
    <form method="POST" action="add_script.php" enctype="multipart/form-data">
        <div class="row">
            <!-- Первый столбец -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Entrez le titre" value="<?php echo isset($artist['title']) ? htmlspecialchars($artist['title']) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" name="year" class="form-control" id="year" placeholder="Entrez l'année" value="<?php echo isset($artist['year']) ? htmlspecialchars($artist['year']) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="label">Label</label>
                    <input type="text" name="label" class="form-control" id="label" placeholder="Entrez le label" value="<?php echo isset($artist['label']) ? htmlspecialchars($artist['label']) : ''; ?>" required>
                </div>
            </div>

            <!-- Второй столбец -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="artist_id">Artiste</label>
                    <select name="artist_id" class="form-control" id="artist_id" required>
                        <!-- Здесь должны быть данные исполнителей -->
                        <?php
                        $artists = $record->query("SELECT * FROM artists")->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($artists as $a) {
                            echo "<option value=\"{$a['id']}\" " . ($a['id'] == $artist_id ? 'selected' : '') . ">{$a['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" name="genre" class="form-control" id="genre" placeholder="Entrez le genre" value="<?php echo isset($artist['genre']) ? htmlspecialchars($artist['genre']) : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">Prix</label>
                    <input type="number" name="price" class="form-control" id="price" placeholder="Entrez le prix" value="<?php echo isset($artist['price']) ? htmlspecialchars($artist['price']) : ''; ?>" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>

</body>
</html>

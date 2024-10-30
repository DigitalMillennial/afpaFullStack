<?php
session_start();
try {
    $record = new PDO('mysql:host=localhost;dbname=record;charset=utf8', 'root', 'root');
    $record->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $disc_id = $_POST['disc_id'];
    $artist_id = $_POST['artist_id']; // Используем artist_id
    $title = $_POST['title'];
    $year = $_POST['year'];
    $label = $_POST['label'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];

    $requete = $record->prepare("SELECT disc_picture FROM disc WHERE disc_id = ?");
    $requete->execute([$disc_id]);
    $currentImage = $requete->fetchColumn();

    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['picture']['tmp_name'];
        $fileName = $_FILES['picture']['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = uniqid() . '.' . $fileExtension;
        $uploadFileDir = './pictures/';
        $dest_path = $uploadFileDir . $newFileName;
        
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $currentImage = $newFileName;
        } else {
            die("Ошибка при загрузке файла.");
        }
    }

    try {
        $requete2 = $record->prepare("UPDATE record.disc SET disc_title=:title, disc_year=:year, disc_picture=:picture, disc_label=:label, disc_genre=:genre, disc_price=:price, artist_id=:artist_id WHERE disc_id=:disc_id;");
        $requete2->execute([
            'title' => $title,
            'year' => $year,
            'picture' => $currentImage,
            'label' => $label,
            'genre' => $genre,
            'price' => $price,
            'artist_id' => $artist_id,
            'disc_id' => $disc_id
        ]);

        if ($requete2->rowCount() > 0) {
            header("Location: liste_des_disques.php");
            exit();
        } else {
            echo "Запись не найдена или данные не изменены.";
        }
    } catch (PDOException $e) {
        die("Ошибка при обновлении в базу данных: " . $e->getMessage());
    }
}
?>

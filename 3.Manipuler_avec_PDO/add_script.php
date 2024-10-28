<?php
try {
    $record = new PDO('mysql:host=localhost;dbname=record;charset=utf8', 'root', 'root');
    $record->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Проверка, если форма была отправлена
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Восстановление информации, передаваемой формой
        $artist_id = $_POST['artist_id'];
        $title = $_POST['title'];
        $year = $_POST['year'];
        
        $label = $_POST['label'];
        $genre = $_POST['genre'];
        $price = $_POST['price'];
    
        if (isset($_FILES['picture'])) {
            $file = $_FILES['picture'];
            
           
            if ($file['error'] === UPLOAD_ERR_OK) {
                
                $fileTmpPath = $file['tmp_name'];
                $fileName = $file['name'];
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                
                
                $newFileName = uniqid() . '.' . $fileExtension;
    
                
                $uploadFileDir = './pictures/';
                $dest_path = $uploadFileDir . $newFileName;
    
                
                if(move_uploaded_file($fileTmpPath, $dest_path)) {
                   
                } else {
                    die("Ошибка при загрузке файла.");
                }
            } else {
                die("Ошибка загрузки файла: " . $file['error']);
            }
        } else {
            die("Файл не загружен.");
        }    
        

        // Подготовка запроса
        $requete = $record->prepare("
            INSERT INTO record.disc (disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id)
            VALUES (:title, :year, :picture, :label, :genre, :price, :artist_id);
        ");
        
        // Привязка параметров
        $requete->bindParam(':title', $title);
        $requete->bindParam(':year', $year);
        $requete->bindParam(':picture', $newFileName);
        $requete->bindParam(':label', $label);
        $requete->bindParam(':genre', $genre);
        $requete->bindParam(':price', $price);
        $requete->bindParam(':artist_id', $artist_id);

        // Выполнение запроса
        $requete->execute();
        
        // Перенаправление на страницу листинга
        header("Location: liste_des_disques.php");
        exit();
    }
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
?>

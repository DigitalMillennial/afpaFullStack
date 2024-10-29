<?php
try {
    $record = new PDO('mysql:host=localhost;dbname=record;charset=utf8', 'root', 'root');
    $record->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Ошибка подключения к базе данных: ' . $e->getMessage());
}

if (isset($_GET['disc_id']) && is_numeric($_GET['disc_id'])) {
    $disc_id = $_GET['disc_id'];
    $requete = $record->prepare("DELETE FROM record.disc WHERE disc_id=:disc_id;");
    $requete->bindParam(':disc_id', $disc_id, PDO::PARAM_INT);

    if ($requete->execute()) {
        header("Location: liste_des_disques.php");
        exit();
    } else {
        echo 'Ошибка при удалении записи.';
    }
} else {
    echo 'Некорректный или отсутствующий disc_id.';
}
?>

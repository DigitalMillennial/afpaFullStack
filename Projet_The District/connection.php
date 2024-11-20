<?php
try {
    $record = new PDO('mysql:host=localhost;dbname=restaurant;charset=utf8', 'root', 'root');
    $record->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
?>
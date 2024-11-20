<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из формы
    $name = htmlspecialchars($_POST['name']);
    $surname = htmlspecialchars($_POST['surname']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Генерируем имя файла на основе текущей даты и времени
    $currentDateTime = date('Y-m-d-H-i-s');  // Формат AAAA-MM-JJ-HH-MM-SS
    $fileName = $currentDateTime . '.txt';   // Имя файла будет например 2024-10-07-12-45-30.txt

    // Содержимое файла
    $fileContent = "Nom: $name\nPrénom: $surname\nEmail: $email\nMessage: $message";

    // Записываем данные в файл
    file_put_contents($fileName, $fileContent);

    // Подтверждение отправки
    echo "Formulaire soumis avec succès. Fichier $fileName créé!";
} else {
    echo "Erreur: méthode de requête non valide.";
}
?>

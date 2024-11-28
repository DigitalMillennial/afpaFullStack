<?php
// Загрузка конфиденциальных данных из переменных окружения
$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'restaurant';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'root';

// Путь к файлу логов
$logFile = __DIR__ . '/error.log';

try {
    // Подключение к базе данных с указанием кодировки UTF-8
    $record = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $record->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Логирование ошибки в файл
    error_log("[" . date('Y-m-d H:i:s') . "] Ошибка подключения: " . $e->getMessage() . "\n", 3, $logFile);
    
    // Вывод безопасного сообщения для пользователя
    die("Временные проблемы с подключением к базе данных. Пожалуйста, попробуйте позже.");
}
?>
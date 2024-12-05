<?php  
include 'connection.php';

function populair(){
    global $record;
    $requete = $record->prepare("SELECT c.libelle, c.image, c.id, sum(quantite)  as total from categorie c 
    left join plat p on p.id_categorie = c.id 
    Left JOIN commande comma on comma.id_plat = p.id 
    GROUP BY c.libelle 
    order BY total DESC 
    limit 6;
    ");
     $requete->execute();
     $popcat = $requete->fetchALL(PDO::FETCH_OBJ);
     return $popcat;
}

function getProducts($idcat) {
    global $idcat;
    global $record; // Подключаем глобальную переменную для работы с базой
    $requete = $record->prepare("
        SELECT 
            id, 
            libelle, 
            prix,                   
            image                   
        FROM plat
        Where id_categorie=?
        limit 6;
    ");
    $requete->execute([$idcat]); 
    return $requete->fetchAll(PDO::FETCH_OBJ); 
}
function getAllProducts() {
    global $record; // Подключаем глобальное соединение с базой
    $requete = $record->prepare("
        SELECT 
            id, 
            libelle, 
            prix, 
            image 
        FROM plat
        WHERE active = 'Yes'
    ");
    $requete->execute(); 
    return $requete->fetchAll(PDO::FETCH_OBJ);
}

// Функция для поиска товаров
function searchProducts($query) {
    global $record; // Используем подключение к базе данных

    $requete = $record->prepare("
        SELECT 
            id, 
            libelle, 
            prix, 
            image 
        FROM plat
        WHERE libelle LIKE :query OR description LIKE :query
    ");
    $requete->execute(['query' => '%' . $query . '%']); // Подставляем значение поиска
    return $requete->fetchAll(PDO::FETCH_OBJ); // Возвращаем найденные результаты
}

// Проверяем, был ли отправлен запрос на поиск
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query = $_GET['query']; // Получаем строку поиска из параметров GET
    $searchResults = searchProducts($query); // Вызываем функцию поиска

    // Выводим результаты поиска
    if (!empty($searchResults)) {
        echo "<h2>Результаты поиска:</h2>";
        foreach ($searchResults as $product) {
            echo "<div class='product'>";
            echo "<h3>" . htmlspecialchars($product->libelle) . "</h3>";
            echo "<p>Цена: " . htmlspecialchars($product->prix) . " €</p>";
            echo "<img src='/img/food/" . htmlspecialchars($product->image) . "' alt='Изображение товара'>";
            echo "</div>";
        }
    } else {
        echo "<p>Ничего не найдено</p>";
    }
} elseif (isset($_GET['query'])) {
    // Если запрос пустой
    echo "<p>Введите запрос для поиска</p>";
}

?>
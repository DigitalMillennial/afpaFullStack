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


?>
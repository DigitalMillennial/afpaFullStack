<?php  
include 'connection.php';

if ($_SERVER['REQUEST_METHOD']==='POST'){
    $nom = $_POST['libelle'];
    $categor = $_POST['id_categorie'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];
    $active = $_POST['active'];
    
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        
       
        if ($file['error'] === UPLOAD_ERR_OK) {
            
            $fileTmpPath = $file['tmp_name'];
            $fileName = $file['name'];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            
            
            $newFileName = uniqid() . '.' . $fileExtension;

            
            $uploadFileDir = './img/food/';
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
}

 // Подготовка запроса
 $requete = $record->prepare("
 INSERT INTO restaurant.plat
(libelle, description, prix, image, id_categorie, active)
VALUES(:libelle, :description, :prix, :image, :id_categorie, :active);
");

$requete ->execute([
 ':libelle' => $nom,
 ':description' => $description,
 ':prix' => $prix,
 ':image' => $newFileName,
 ':id_categorie' => $categor,
 ':active' =>  $active
]);

// Перенаправление на страницу листинга
header("Location: all_plats.php");
exit();

?>
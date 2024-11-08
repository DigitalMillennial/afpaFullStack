<?php
// Подключаем класс Employe
include 'Employe.php';
include 'Stores.php';

// Создаем 5 объектов магазинов
$store1 = new Stores("Magasin Central", "10 Rue de la Paix", "75001", "Paris","Chèque");
$store2 = new Stores("Magasin Lyonnais", "20 Rue de Lyon", "69001", "Lyon","Cantine");
$store3 = new Stores("Magasin Bordelais", "30 Rue Sainte-Catherine", "33000", "Bordeaux","Cantine");
$store4 = new Stores("Magasin Marseillais", "40 Rue Paradis", "13000", "Marseille","Chèque");
$store5 = new Stores("Magasin Lillois", "50 Grand Place", "59000", "Lille","Cantine");

// Создаем 5 объектов сотрудников с разными данными
$employee1 = new Employe("Lebowski", "Jeff", "2023-10-01", "Admin", "26000", "IT", $store1,[10,18]);
$employee2 = new Employe("Smith", "John", "2020-05-15", "Manager", "45000", "HR", $store2,[2,8]);
$employee3 = new Employe("Taylor", "Alicia", "2024-01-12", "Developer", "50000", "Tech", $store3,[19]);
$employee4 = new Employe("Brown", "Mike", "2018-07-23", "Designer", "48000", "Marketing", $store4,[1]);
$employee5 = new Employe("Davis", "Emily", "2017-03-30", "CEO", "75000", "Executive", $store5,[15]);

$employee1 -> getvoyage();
$employee2 -> getvoyage();
$employee3 -> getvoyage();
$employee4 -> getvoyage();
$employee5 -> getvoyage();
// Выводим данные всех сотрудников
echo "<table border='1'>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Embauche</th>
            <th>Poste</th>
            <th>Brut</th>
            <th>Service</th>
            <th>Bonus</th>
            <th>Ancienneté</th>
            <th>Magasin</th>
            <th>Restauration</th>
            <th>Voyage</th>
            <th>Chèque Noël</th>
        </tr>";

echo $employee1;
echo $employee2;
echo $employee3;
echo $employee4;
echo $employee5;

echo "</table>";
?>

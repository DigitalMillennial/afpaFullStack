<?php
// Подключаем класс Employe
include 'Employe.php'; 

// Создаем 5 объектов сотрудников с разными данными
$employee1 = new Employe("Lebowski", "Jeff", "2023-10-01", "Admin", "26000", "IT");
$employee2 = new Employe("Smith", "John", "2020-05-15", "Manager", "45000", "HR");
$employee3 = new Employe("Taylor", "Alicia", "2019-01-12", "Developer", "50000", "Tech");
$employee4 = new Employe("Brown", "Mike", "2018-07-23", "Designer", "48000", "Marketing");
$employee5 = new Employe("Davis", "Emily", "2017-03-30", "CEO", "75000", "Executive");

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
        </tr>";

echo $employee1;
echo $employee2;
echo $employee3;
echo $employee4;
echo $employee5;

echo "</table>";
?>

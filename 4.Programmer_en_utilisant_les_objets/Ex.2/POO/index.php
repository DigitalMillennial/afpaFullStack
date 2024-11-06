<?php
// include './classes/Employe.class.php'; // Подключаем класс Employe
include 'Employe.php'; // Подключаем класс Employe
//require 'Employe.php';

$p = new Employe();
$p->setNom("Lebowski");
$p->setPrenom("Jeff");
$p->setEmbauche("2023-10-01"); // Дата трудоустройства в формате строки
$p->setPoste("Admin"); // Должность в компании
$p->setBrut("26000"); // Заработная плата в тысячах евро брутто в год
$p->setService("IT"); // Отдел в компании

// Вывод объекта (вызовет метод __toString)
echo nl2br($p); // Используем nl2br для корректного отображения новых строк в HTML
?>

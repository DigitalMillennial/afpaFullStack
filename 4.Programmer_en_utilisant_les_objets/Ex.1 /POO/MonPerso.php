<?php
include 'classes/Personnage.class.php';

$p = new Personnage();
$p->setNom("Lebowski");
$p->setPrenom("Jeff");
$p->setAge(42); // Добавим возраст
$p->setSexe("masculin"); // Добавим пол

// Вывод объекта (вызовет метод __toString)
echo nl2br($p); // Используем nl2br для корректного отображения новых строк в HTML
?>

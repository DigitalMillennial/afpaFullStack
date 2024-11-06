<?php
// Employe.php

class Employe {
    private $nom;
    private $prenom;
    private $embauche;
    private $poste;
    private $brut;
    private $service;

    // Конструктор для инициализации данных
    public function __construct($nom, $prenom, $embauche, $poste, $brut, $service) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->embauche = $embauche;
        $this->poste = $poste;
        $this->brut = $brut;
        $this->service = $service;
    }

    // Метод для вычисления бонуса
    public function getBonus() {
        $yearsOfService = $this->getAnneeService();
        $bonus = $this->brut * 0.05 + $this->brut * 0.02 * $yearsOfService;
        return $bonus;
    }

    // Метод для вычисления стажа
    public function getAnneeService() {
        $dateEmbauche = new DateTime($this->embauche);
        $dateToday = new DateTime();
        $interval = $dateToday->diff($dateEmbauche);
        return $interval->y;
    }

    // Метод __toString() для вывода данных сотрудника
    public function __toString() {
        $bonus = $this->getBonus();  // Получаем бонус
        $anciennete = $this->getAnneeService();  // Получаем стаж

        return "<tr>
                    <td>" . $this->nom . "</td>
                    <td>" . $this->prenom . "</td>
                    <td>" . $this->embauche . "</td>
                    <td>" . $this->poste . "</td>
                    <td>" . $this->brut . " K euros</td>
                    <td>" . $this->service . "</td>
                    <td>" . $bonus . " EUR</td>
                    <td>" . $anciennete . " Année</td>
                </tr>";
    }
}
?>

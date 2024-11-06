<?php
class Employe {
    private $nom;      // Имя
    private $prenom;   // Фамилия
    private $embauche; // Дата найма
    private $poste;    // Должность
    private $brut;     // Заработная плата в тысячах евро брутто в год
    private $service;  // Отдел, в котором находится сотрудник

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getEmbauche() {
        return $this->embauche;
    }

    public function setEmbauche($embauche) {
        $this->embauche = $embauche;
    }

    public function getPoste() {
        return $this->poste;
    }

    public function setPoste($poste) {
        $this->poste = $poste;
    }

    public function getBrut() {
        return $this->brut;
    }

    public function setBrut($brut) {
        $this->brut = $brut;
    }

    public function getService() {
        return $this->service;
    }

    public function setService($service) {
        $this->service = $service;
    }

    // Метод для корректного отображения объекта
    public function __toString() {
        return "Nom: " . $this->nom . "<br>" .
               "Prénom: " . $this->prenom . "<br>" .
               "Embauche: " . $this->embauche . "<br>" .
               "Poste: " . $this->poste . "<br>" .
               "Brut: " . $this->brut . " K euros<br>" .
               "Service: " . $this->service . "<br>";
    }
}
?>

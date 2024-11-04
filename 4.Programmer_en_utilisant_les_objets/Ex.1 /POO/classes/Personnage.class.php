<?php
class Personnage {
    private $nom; // Имя
    private $prenom; // Фамилия
    private $age; // Возраст
    private $sexe; // Пол
    
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

    public function getAge() {
        return $this->age;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function getSexe() {
        return $this->sexe;
    }

    public function setSexe($sexe) {
        $this->sexe = $sexe;
    }

    public function __toString() {
        return "Имя: " . $this->getNom() . "\n" . 
               "Фамилия: " . $this->getPrenom() . "\n" . 
               "Возраст: " . $this->getAge() . "\n" .
               "Пол: " . $this->getSexe();
    }
}
?>

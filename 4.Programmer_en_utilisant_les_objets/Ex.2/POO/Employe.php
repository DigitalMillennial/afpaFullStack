<?php
// Employe.php

class Employe {
    private $nom;
    private $prenom;
    private $embauche;
    private $poste;
    private $brut;
    private $service;
    private $magasin; 
    private $voyage;
    private $child_age;

    // Конструктор для инициализации данных
    public function __construct($nom, $prenom, $embauche, $poste, $brut, $service, $magasin,$child_age=[]) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->embauche = $embauche;
        $this->poste = $poste;
        $this->brut = $brut;
        $this->service = $service;
        $this->magasin = $magasin;
        $this->voyage = "non";
        $this->child_age = $child_age;       
    }

    public function getMagasin() {
        return $this->magasin;
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
    // Метод для вычисления путёвок по стажу
    public function getvoyage() {
        $i = $this-> getAnneeService();
        if($i>=1){
            $this->voyage = "oui";
        } else{
            $this->voyage = "non";
        }        
        return $this->voyage;
    }

       // Метод для вычисления cумма рождественского ваучера
       public function child_age() {
        if (empty($child_age)) {
            $result  = "Aucun chèque accepté";
        }
        $cheque = ["20€"=>0,"30€"=>0,"50€"=>0];
        foreach ($this->child_age as $child ){
            if($child>0 && $child<=10){
                $cheque ["20€"]++;
            }elseif($child>=11 && $child<=15){
                $cheque ["30€"]++;
            }elseif($child>=16 && $child<=18){
                $cheque ["50€"]++;
            }elseif($child>18){
               return $result  = "Aucun chèque accepté";
            }
            $result = "chèque Noël:. <br>" ;
            foreach($cheque as $value=>$quantite){
                if($quantite>0){
                    $result .= $value . "-" .$quantite  . "pcs<br>";
                }
            }
        }   
        return $result;
    }

    // Метод __toString() для вывода данных сотрудника
    public function __toString() {
        $bonus = $this->getBonus();  // Получаем бонус
        $anciennete = $this->getAnneeService();  // Получаем стаж
        // Проверяем, есть ли привязка к магазину, и выводим его данные        

        return "<tr>
                    <td>" . $this->nom . "</td>
                    <td>" . $this->prenom . "</td>
                    <td>" . $this->embauche . "</td>
                    <td>" . $this->poste . "</td>
                    <td>" . $this->brut . " K euros</td>
                    <td>" . $this->service . "</td>
                    <td>" . $bonus . " EUR</td>
                    <td>" . $anciennete . " Année</td>
                    <td>" . $this->magasin->getNomDuMagasin() ."</td> 
                    <td>" . $this->magasin->getrestau() ."</td> 
                    <td>" . $this->voyage . "</td> 
                    <td>" . $this->child_age() . "</td>                   
                </tr>";
    }
}
?>

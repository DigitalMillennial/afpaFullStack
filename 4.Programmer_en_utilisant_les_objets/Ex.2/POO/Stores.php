<?php

class Stores {
    private $nom_du_magasin;
    private $adresse;
    private $Code_Postal;
    private $ville;
    private $magasin; 
    private $restauration;

    public function __construct($nom_du_magasin, $adresse, $Code_Postal, $ville,$restauration) {
        $this->nom_du_magasin = $nom_du_magasin;
        $this->adresse = $adresse;
        $this->Code_Postal = $Code_Postal;
        $this->ville = $ville;
        $this->restauration = $restauration;
    }
    
    public function getNomDuMagasin() {
        return $this->nom_du_magasin;
    }

    public function getAdresse() {
        return $this->adresse;
    }
    public function getrestau() {
        return $this->restauration;
    }


}

?>
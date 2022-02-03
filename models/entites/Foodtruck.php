<?php 
    class Foodtruck {
        private $id;
        private $nom;
        private $siteweb;
        private $reservations;
        private $utilisateur;

        public function __construct($id, $nom, $siteweb, $utilisateur){
            $this->id = $id;
            $this->nom = $nom;
            $this->siteweb = $siteweb;
            $this->utilisateur = $utilisateur;

        }

        public function __get($prop){
            if(property_exists($this, $prop)){
                return $this->$prop;
            }
        }

        public function __set($prop, $value){
            if(property_exists($this, $prop)){
                $this->$prop = $value;
            }
        }
    }
?>
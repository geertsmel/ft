<?php 
    class Reservation {
        private $id;
        private $date;
        private $statut;
        private $foodtruck;
        
        public function __construct($id, $date, $statut, $foodtruck){
            $this->id = $id;
            $this->date = $date;
            $this->statut = $statut;
            $this->foodtruck = $foodtruck;

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
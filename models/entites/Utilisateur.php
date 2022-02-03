<?php 
    class Utilisateur {
        private $id;
        private $login;
        private $mdp;
        private $role;

        public function __construct($id, $login, $role, $mdp = null){
            $this->id = $id;
            $this->login = $login;
            $this->mdp = $mdp;
            $this->role = intval($role);

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
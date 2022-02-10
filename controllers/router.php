<?php 
    $tabDroits = [ 
        // anonyme
        0 => [
            "accueil" => "accueilController",
            "connexion" => "connexionController"
        ],
        // techno
        1 => [
            "accueil" => "tf/accueilTFController",
            "planning" => "tf/planningController",
            "foodtrucks" => "tf/foodtrucksController",
            "deconnexion" => "deconnexionController"
        ],
        // foodtruck
        2 => [
            "accueil" => "ft/accueilFTController",
            "accepter" => "ft/accepterController",
            "refuser" => "ft/refuserController",
            "deconnexion" => "deconnexionController"
        ]
    ];


    $role = 0;

    if(isset($_SESSION["user"])){
        $role = $_SESSION["user"]->role;        
    }

    if(!isset($_GET["section"])){
        $_GET["section"]= "accueil";
    }

    //var_dump($role);
    if(array_key_exists($_GET["section"], $tabDroits[$role])){
        include_once("controllers/" . $tabDroits[$role][$_GET["section"]] . ".php");
    }
    else {
        include_once("controllers/erreurController.php");
    }

    

?>
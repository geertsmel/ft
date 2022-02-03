<?php 
    include_once("models/dao/ReservationDAO.php");
    include_once("models/dao/FoodtruckDAO.php");
    include_once("models/dao/StatutDAO.php");

    $foodtrucksDAO = new FoodtruckDAO();
    $reservationDAO = new ReservationDAO();
    
    $foodtrucks = $foodtrucksDAO->fetchAll();
    // var_dump($foodtrucks);
    $tabAction = [
        "ajouter",
        "modifier",
        "supprimer"
    ];


    $reservation= new Reservation(null, null, null, null);
    
    if(isset($_GET["action"]) && in_array($_GET["action"], $tabAction)){
        
        if(isset($_GET["id"])){
            $reservations = $reservationDAO->fetchWhere("id", $_GET["id"]);
            if(count($reservations)==1){
                $reservation = $reservations[0];

            }
            else {
                include_once("views/page/erreur.php");
                die;
            }
            // var_dump($reservation);
            
        }
        
        if(!empty($_POST["date"]) && !empty($_POST["fk_foodtruck"])){
        
            $data = [
                "id" => (isset($_POST["id"])) ? $_POST["id"] : 0,
                "date" => $_POST["date"],
                "fk_statut" => 1,
                "fk_foodtruck" => $_POST["fk_foodtruck"]
            ];
         

            switch($_POST["submit"]){
                case "ajouter":
                    if($reservationDAO->store($data)){
                        header("Location:?section=accueil");
                    }
                    break;
                case "modifier":
                    if($reservationDAO->update($data, $data["fk_statut"])){
                        header("Location:?section=accueil");
                    }
                    break;
                case "supprimer":
                    if($reservationDAO->delete($data)){
                        header("Location:?section=accueil");
                    }
                    break;
                
                
            }
        }


        include_once("views/page/tf/planning/".$_GET["action"].".php");
        
    }
    else {
        include_once("views/page/erreur.php");
    }

?>
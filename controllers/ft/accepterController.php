<?php 
    include_once("models/dao/ReservationDAO.php");
    include_once("models/dao/FoodtruckDAO.php");
    include_once("models/dao/StatutDAO.php");
    $msgError = "";
    if(isset($_GET["id"])){
        $reservationDAO = new ReservationDAO();
        $reservations = $reservationDAO->fetchWhere("id", $_GET["id"]);
        if(count($reservations) == 1 && $reservations[0]->foodtruck->utilisateur == $_SESSION["user"]->id){
            $reservation = $reservations[0];
            // var_dump($reservation);
            if(isset($_POST["id"])){
                if($_POST["id"] == $reservation->id){
                    // var_dump($_POST);
                    if($reservationDAO->update($_POST, "2")){
                        header("Location:?section=accueil");
                    }
                    else {
                        $msgError = '<p class="alert">Une erreur est survenue</p>';
                    }
                }
                else{
                    $msgError = '<p class="alert">Une erreur est survenue</p>';
                }
                
                
                
            }
            include_once("views/page/ft/accepter.php");
        }
        else {
            include_once("views/page/erreur.php");
        }
        

    }
    else {
        include_once("views/page/erreur.php");
    }

    
?>
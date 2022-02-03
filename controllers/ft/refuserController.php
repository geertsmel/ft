<?php 
    include_once("models/dao/ReservationDAO.php");
    include_once("models/dao/FoodtruckDAO.php");
    include_once("models/dao/StatutDAO.php");
    $msgError = "";
    if(isset($_GET["id"])){
        $reservationDAO = new ReservationDAO();
        $reservation = $reservationDAO->fetchWhere("id", $_GET["id"])[0];
        // var_dump($reservation);
        if(isset($_POST["id"])){
            if($_POST["id"] == $reservation->id){
                // var_dump($_POST);
                if($reservationDAO->update($_POST, "3")){
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
        include_once("views/page/ft/refuser.php");

    }
    else {
        include_once("views/page/erreur.php");
    }

    
?>
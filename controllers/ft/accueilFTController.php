<?php 
    include_once("models/dao/ReservationDAO.php");
    include_once("models/dao/FoodtruckDAO.php");
    include_once("models/dao/StatutDAO.php");
    
    
    // var_dump($_SESSION["user"]->id);
    $foodtruckDAO = new FoodtruckDAO();
    $foodtruck = $foodtruckDAO->fetchWhere("fk_utilisateur", $_SESSION["user"]->id)[0];
    // var_dump($foodtruck);

    $reservationDAO = new ReservationDAO();
    
    $reservations = $reservationDAO->fetchWhere("fk_foodtruck", $foodtruck->id);
    // var_dump($reservations);
    include_once("views/page/ft/accueil.php");
?>
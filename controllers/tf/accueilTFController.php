<?php 
    include_once("models/dao/ReservationDAO.php");
    include_once("models/dao/FoodtruckDAO.php");
    include_once("models/dao/StatutDAO.php");
    

    $reservationDAO = new ReservationDAO();
    
    $reservations = $reservationDAO->fetchAll();
    // var_dump($reservations);
    include_once("views/page/tf/accueil.php");
?>
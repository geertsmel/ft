<?php 
    include_once("models/dao/ReservationDAO.php");
    include_once("models/dao/FoodtruckDAO.php");
    include_once("models/dao/StatutDAO.php");
    include_once("models/dao/UtilisateurDAO.php");
    
    $reservationDAO = new ReservationDAO();
    $reservations = $reservationDAO->fetchWhere("fk_statut", 2);
    //var_dump($reservations);

    // $foodtruckDAO = new FoodtruckDAO();
    // $foodtrucks = $foodtruckDAO->fetchAll();
    // var_dump($foodtrucks);

    // $statutDAO = new StatutDAO();
    // $statuts = $statutDAO->fetchAll();
    // var_dump($statuts);

    // $utilisateurDAO = new utilisateurDAO();
    // $utilisateurs = $utilisateurDAO->fetchAll();
    // var_dump($utilisateurs);



    include_once("views/page/accueil.php");
?>
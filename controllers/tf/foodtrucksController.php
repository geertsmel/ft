<?php 
    include_once("models/dao/FoodtruckDAO.php");
    $foodtrucksDAO = new FoodtruckDAO();
    
    $foodtrucks = $foodtrucksDAO->fetchAll();
    var_dump($foodtrucks);
    include_once("views/page/tf/foodtrucks.php");
?>
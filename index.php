<?php 
    include_once("models/dao/UtilisateurDAO.php");
    session_start();
    ob_start(); // pour que header fonctionne

    include("views/html/header.php");
    if(!isset($_SESSION["user"])){
        include("views/menu/menu.php");
    }
    else{
        switch($_SESSION["user"]->role){
            case 1 :
                include("views/menu/menu-tf.php");
                break;
            case 2 :
                include("views/menu/menu-ft.php");
                break;
        }
    }
    
    include("controllers/router.php");
    include("views/html/footer.php");
?>
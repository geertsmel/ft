<?php 
    // si il y a une demande dans url
    if(isset($_GET["section"])){
        switch($_GET["section"]){
            case "accueil":
                include_once("controllers/accueilController.php");
                break;
            case "connexion":
                include_once("controllers/connexionController.php");
                break;
            default :
                //erreur 404 : page non trouvée
                include_once("controllers/erreurController.php");
                break;
        }

    }
    else {
        include_once("controllers/accueilController.php");
    }
    

?>
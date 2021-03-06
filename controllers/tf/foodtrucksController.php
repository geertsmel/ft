<?php 
    include_once("models/dao/FoodtruckDAO.php");
    $foodtrucksDAO = new FoodtruckDAO();
    
    $foodtrucks = $foodtrucksDAO->fetchAll();
    // var_dump($foodtrucks);

    $utilisateursDAO = new UtilisateurDAO();
    
    $utilisateurs = $utilisateursDAO->fetchWhere("role", 2);
    //  var_dump($utilisateurs);
    
    $tabAction = [
        "voir",
        "ajouter",
        "modifier",
        "supprimer"
    ];


    
    
    if(isset($_GET["action"]) && in_array($_GET["action"], $tabAction)){
        
        if(isset($_GET["id"])){
            $foodtrucks = $foodtrucksDAO->fetchWhere("id", $_GET["id"]);
            if(count($foodtrucks)==1){
                $foodtruck = $foodtrucks[0];
            }
            else {
                include_once("views/page/erreur.php");
                die;
            }
            // var_dump($rfoodtruck);
            
        }
        
        if(!empty($_POST["nom"]) && !empty($_POST["siteweb"]) && !empty($_POST["utilisateur"])){
        
            $data = [
                "id" => (isset($_POST["id"])) ? $_POST["id"] : 0,
                "nom" => $_POST["nom"],
                "siteweb" => $_POST["siteweb"],
                "fk_utilisateur" => $_POST["utilisateur"]
            ];
            // var_dump($data);
            // die;
            switch($_POST["submit"]){
                case "ajouter":
                    if($foodtrucksDAO->store($data)){
                        header("Location:?section=foodtrucks&action=voir");
                    }
                    break;
                case "modifier":
                    if(isset($_GET["id"]) && $_GET["id"] == $data["id"]){
                        if($foodtrucksDAO->update($_GET["id"], $data)){
                            header("Location:?section=foodtrucks&action=voir");
                        }
                    }
                    else {
                        include_once("views/page/erreur.php");
                        die;
                    }
                    
                    break;
                case "supprimer":
                    if(isset($_GET["id"]) && $_GET["id"] == $data["id"]){
                        if($foodtrucksDAO->delete($data)){
                            header("Location:?section=foodtrucks&action=voir");
                        }
                    }
                    else {
                        include_once("views/page/erreur.php");
                        die;
                    }
                    
                    break; 
            }
        }
        include_once("views/page/tf/foodtrucks/".$_GET["action"].".php");
    }
    else {
        include_once("views/page/erreur.php");
    }
?>
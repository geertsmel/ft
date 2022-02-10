<?php 
    include_once("models/dao/UtilisateurDAO.php");
    $utilisateursDAO = new UtilisateurDAO();
    
    //$utilisateurs = $utilisateursDAO->fetchWhere("role",2);
    $utilisateurs = $utilisateursDAO->fetchAll(true);
    // var_dump($utilisateurs);

    $tabAction = [
        "voir",
        "ajouter",
        "modifier",
        "supprimer"
    ];


    
    
    if(isset($_GET["action"]) && in_array($_GET["action"], $tabAction)){
        
        if(isset($_GET["id"])){
            $utilisateurs = $utilisateursDAO->fetchWhere("id", $_GET["id"], true);
            if(count($utilisateurs)==1){
                $utilisateur = $utilisateurs[0];
            }
            else {
                include_once("views/page/erreur.php");
                die;
            }
            // var_dump($utilisateur);

            
        }
        
        if(!empty($_POST["login"]) && !empty($_POST["mdp"]) && !empty($_POST["role"])){
        
            $data = [
                "id" => (isset($_POST["id"])) ? $_POST["id"] : 0,
                "login" => $_POST["login"],
                "mdp" => $_POST["mdp"],
                "role" => $_POST["role"]
            ];
            switch($_POST["submit"]){
                case "ajouter":
                    if($utilisateursDAO->store($data)){
                        header("Location:?section=utilisateurs&action=voir");
                    }
                    break;
                case "modifier":
                    if(isset($_GET["id"]) && $_GET["id"] == $data["id"]){
                        if($utilisateursDAO->update($_GET["id"], $data)){
                            header("Location:?section=utilisateurs&action=voir");
                        }
                    }
                    else {
                        include_once("views/page/erreur.php");
                        die;
                    }
                    
                    break;
                case "supprimer":
                    
                    if(isset($_GET["id"]) && $_GET["id"] == $data["id"]){
                        if($utilisateursDAO->delete($data)){
                            header("Location:?section=utilisateurs&action=voir");
                        }
                    }
                    else {
                        include_once("views/page/erreur.php");
                        die;
                    }
                    
                    break; 
            }
        }
        include_once("views/page/tf/utilisateurs/".$_GET["action"].".php");
    }
    else {
        include_once("views/page/erreur.php");
    }
?>
<?php 
    include_once("models/dao/UtilisateurDAO.php");
    // vérifier que les 2 champs soient remplis
    if(isset($_POST["login"], $_POST["mdp"])){
        $login = $_POST["login"];
        $mdp = $_POST["mdp"];
        // vérifie que les 2 champs aient un caractère
        if(trim($login) != "" && trim($mdp) !=""){
            $userDAO = new UtilisateurDAO();
            $exist = $userDAO->verify($login, $mdp);
            var_dump($exist);
            if(!empty($exist)){
                $_SESSION["user"] = $exist;
                // rediriger vers la page d'acccuil en fonction du role
                header("Location:?section=accueil");
                
            }
        }

    }


    include_once("views/page/connexion.php");
?>
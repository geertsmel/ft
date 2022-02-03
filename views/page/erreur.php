<?php 
    $tabColor= [
        0 => "yellow",
        1 => "red",
        2 => "orange"
    ];
    $role = ($_SESSION["user"]) ? $_SESSION["user"]->role : 0;
?>

<div class="<?= $tabColor[$role] ?>">
    <h2>Erreur</h2>
    <p>Page non trouvée. Revenir à la page <a href="?section=accueil">Accueil</a></p>
</div>

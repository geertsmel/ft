<nav>
    <a href="?section=accueil"><img src="public/images/logo.png" alt="Logo"></a>
    <p><a href="?section=accueil">Planning</a></p>
    <p><a href="?section=foodtrucks&action=voir">Foodtrucks</a></p>
    <p><a href="?section=utilisateurs&action=voir">Utilisateurs</a></p>
    <p>
        <?= $_SESSION["user"]->login; ?> 
        <button><a href="?section=deconnexion">Déconnexion</a></button>
    </p>
    
</nav>
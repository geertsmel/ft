<nav>
    <a href="?section=accueil"><img src="public/images/logo.png" alt="Logo"></a>
   
    <p>
        <?= $_SESSION["user"]->login; ?> 
        <button><a href="?section=deconnexion">Déconnexion</a></button>
    </p>
</nav>
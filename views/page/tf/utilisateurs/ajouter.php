<div class="red">
    <?php 
        if(isset($_SESSION["message"])){
            echo $_SESSION["message"];
            $_SESSION["message"] = "";
        }
    ?>
    <form action="#" method="post">
        <h2>Ajouter un utilisateur</h2>
        <div>
            <label for="login">Login :</label>
            <input type="text" name="login" id="login">
        </div>
        <div>
            <label for="mdp">Mdp :</label>
            <input type="text" name="mdp" id="mdp">           
        </div>
        <div>
            <label for="role">Rôle :</label>
            <select name="role" id="role">
                <option value="1">Admin</option>
                <option value="2" selected>Foodtruck</option>
            </select>
        </div>
        <div>
            <button class="btn-red"><a href="?section=utilisateurs&action=voir">Annuler</a></button>
            <button type="submit" class="btn-green" name="submit" value="ajouter">Ajouter</button>
        </div>
    </form>
</div>
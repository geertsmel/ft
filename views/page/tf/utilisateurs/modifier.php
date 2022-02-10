<div class="red">
    <?php 
        if(isset($_SESSION["message"])){
            echo $_SESSION["message"];
            $_SESSION["message"] = "";
        }
        $selectedAdmin = "";
        $selectedFoodtruck = "";

        if($utilisateur->role == 1){
            $selectedAdmin = "selected";
        }
        elseif ($utilisateur->role == 2){
            $selectedFoodtruck = "selected";
        }
    ?>
    <form action="#" method="post">
        <h2>Modifier un utilisateur</h2>
        <div>
            <input type="hidden" name="id" value="<?= $utilisateur->id ?>">
            <label for="login">Login :</label>
            <input type="text" name="login" id="login" value="<?= $utilisateur->login ?>">
        </div>
        <div>
            <label for="mdp">Mdp :</label>
            <input type="text" name="mdp" id="mdp" value="<?= $utilisateur->mdp ?>">           
        </div>
        <div>
            <label for="role">Rôle :</label>
            <select name="role" id="role">
                <option value="1" <?= $selectedAdmin ?>>Admin</option>
                <option value="2" <?= $selectedFoodtruck ?>>Foodtruck</option>
            </select>
        </div>
        <div>
            <button class="btn-red"><a href="?section=utilisateurs&action=voir">Annuler</a></button>
            <button type="submit" class="btn-green" name="submit" value="modifier">Modifier</button>
        </div>
    </form>
</div>
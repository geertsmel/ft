<div class="red">
    <?php 
        if(isset($_SESSION["message"])){
            echo $_SESSION["message"];
            $_SESSION["message"] = "";
        }
    ?>
    <form action="#" method="post">
        <h2>Ajouter un foodtruck</h2>
        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom">
        </div>
        <div>
            <label for="siteweb">Site web :</label>
            <input type="url" name="siteweb" id="siteweb">           
        </div>
        <div>
            <label for="utilisateur">Utilisateur :</label>
            <select name="utilisateur" id="utilisateur">
                <?php foreach($utilisateurs as $u): ?>
                    <option value="<?= $u->id ?>"><?= $u->login ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <button class="btn-red"><a href="?section=foodtrucks&action=voir">Annuler</a></button>
            <button type="submit" class="btn-green" name="submit" value="ajouter">Ajouter</button>
        </div>
    </form>
</div>
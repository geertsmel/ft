<div class="red">
    <?php 
        if(isset($_SESSION["message"])){
            echo $_SESSION["message"];
            $_SESSION["message"] = "";
        }
    ?>
    <form action="#" method="post">
        <h2>Supprimer un foodtruck</h2>
        <div>
            <input type="hidden" name="id" value="<?= $foodtruck->id; ?>">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="<?= $foodtruck->nom; ?>" readonly>
        </div>
        <div>
        <label for="siteweb">Site web :</label>
            <input type="url" name="siteweb" id="siteweb" value="<?= $foodtruck->siteweb; ?>" readonly>
        </div>
        <div>
            <button class="btn-red"><a href="?section=foodtrucks&action=voir">Annuler</a></button>
            <button type="submit" class="btn-green" name="submit" value="supprimer">Supprimer</button>
        </div>
    </form>
</div>
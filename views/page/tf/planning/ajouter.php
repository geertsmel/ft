<div class="red">
    <?php 
        if(isset($_SESSION["message"])){
            echo $_SESSION["message"];
            $_SESSION["message"] = "";
        }
    ?>
    <form action="#" method="post">
        <h2>Ajouter une date</h2>
        <div>
            <label for="date">Date :</label>
            <input type="date" name="date" id="date">
        </div>
        <div>
            <label for="fk_foodtruck">Foodtruck</label>
            <select name="fk_foodtruck" id="fk_foodtruck">
                <?php foreach($foodtrucks as $f): ?>
                    <option value="<?= $f->id; ?>"><?= $f->nom; ?></option>
                <?php endforeach; ?>
            </select>            
        </div>
        <div>
            <button class="btn-red"><a href="?section=accueil">Annuler</a></button>
            <button type="submit" class="btn-green" name="submit" value="ajouter">Ajouter</button>
        </div>
    </form>
</div>
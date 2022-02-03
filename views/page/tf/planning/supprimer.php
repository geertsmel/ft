<div class="red">
    <form action="#" method="post">
    <?php 
        if(isset($_SESSION["message"])){
            echo $_SESSION["message"];
            $_SESSION["message"] = "";
            
        }
    ?>
        <h2>Supprimer une date</h2>
        <div>
            <input type="hidden" name="id" value="<?= $reservation->id; ?>">
            <label for="date">Date :</label>
            <input type="date" name="date" id="date" value="<?= $reservation->date; ?>" readonly>
        </div>
        <div>
            <label for="fk_foodtruck">Foodtruck</label>
            <select name="fk_foodtruck" id="fk_foodtruck" readonly>
                <?php foreach($foodtrucks as $f): ?>
                    <option value="<?= $f->id; ?>"
                    <?php if($f->id == $reservation->foodtruck->id): ?>
                        selected
                    <?php endif; ?>
                    ><?= $f->nom; ?></option>
                <?php endforeach; ?>
            </select>            
        </div>
        <div>
            <button class="btn-red"><a href="?section=accueil">Annuler</a></button>
            <button type="submit" class="btn-green" name="submit" value="supprimer">Supprimer</button>
        </div>
    </form>
</div>
<div class="orange">
    <h2>Je refuse</h2>
    <form action="#" method="post">
        <div>
            <input type="hidden" name="id" value="<?= $reservation->id ?>">
            <input type="hidden" name="date" value="<?= $reservation->date?>">
            <input type="hidden" name="fk_foodtruck" value="<?= $reservation->foodtruck->id ?>">
            <label for="date">Date : <?= $reservation->date ?></label>
        </div>
        <div>
            <label for="commentaires">Commentaires :</label>
            <textarea name="commentaires" id="commentaires" cols="60" rows="1"></textarea>
        </div>
        <div>
            <button  class="btn-red"><a href="?section=accueil" >Annuler</a></button>
            <button type="submit" class="btn-green">Envoyer</button>
        </div>
        <?= $msgError; ?> 

    </form>
</div>
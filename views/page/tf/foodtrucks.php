<div class="red">
<div class="row space-between">
        <h2>Foodtrucks</h2>
        <button class="btn-green"><a href="?section=ajouter">Ajouter un foodtruck</a></button>
    </div>
    <?php if(count($foodtrucks) > 0) : ?>
        <table>
            <tr>
                <th>Nom</th>
                <th>Site web</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php foreach($foodtrucks as $f): ?>
            <tr>
                <td><?= $f->nom; ?></td>
                <td><?= $f->siteweb; ?></td>
                <td>
                    <a href="?section=modifier&id=<?= $f->id?>">&#128394;</a>
                </td>
                <td>
                    <a href="?section=supprimer&id=<?= $f->id?>">&#128465;</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p class="alert">Il n'y pas de foodtrucks</p>
    <?php endif; ?>
</div>
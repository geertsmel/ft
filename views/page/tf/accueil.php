<div class="red">
    <div class="row space-between">
        <h2>Planning</h2>
        <button class="btn-green"><a href="?section=planning&action=ajouter">Ajouter une date</a></button>
    </div>
    <?php if(count($reservations) > 0) : ?>
        <table>
            <tr>
                <th>Date</th>
                <th>Nom du foodtruck</th>
                <th>Statut</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php foreach($reservations as $r): ?>
            <tr>
                <td><?= $r->date; ?></td>
                <td><?= $r->foodtruck->nom; ?></td>
                <td>
                    <?= $r->statut->nom; ?>
                    <?php if($r->statut->id == "1") : ?>
                        &#9203;
                    <?php elseif($r->statut->id == "2") : ?>
                       &#9989;
                    <?php elseif($r->statut->id == "3") : ?>
                        &#10060;
                    <?php endif; ?>
                </td>
                <td>
                    <a href="?section=planning&action=modifier&id=<?= $r->id?>">&#128394;</a>
                </td>
                <td>
                    <a href="?section=planning&action=supprimer&id=<?= $r->id?>">&#128465;</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p class="alert">Il n'y pas de réservation</p>
    <?php endif; ?>
</div>
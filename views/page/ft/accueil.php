<div class="orange">
    <h2>Planning</h2>
    <?php if(count($reservations) > 0) : ?>
        <table>
            <tr>
                <th>Date</th>
                <th>Statut</th>
            </tr>
            <?php foreach($reservations as $r): ?>
            <tr>
                <td><?= $r->date; ?></td>
                <td>
                    <?= $r->statut->nom; ?>
                    <?php if($r->statut->id == "1") : ?>
                        : <a href="?section=accepter&id=<?= $r->id?>">&#9989;</a> ou 
                        <a href="?section=refuser&id=<?= $r->id?>">&#10060;</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p class="alert">Il n'y pas de réservation</p>
    <?php endif; ?>
</div>
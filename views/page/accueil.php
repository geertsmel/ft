<div class="yellow">
    <h3>Planning</h3>
    <table>
        <tr>
            <th>Date</th>
            <th>Nom du foodtruck</th>
            <th>Site web</th>
        </tr>
        <?php foreach($reservations as $r): ?>
        <tr>
            <td><?= $r->date; ?></td>
            <td><?= $r->foodtruck->nom; ?></td>
            <td><?= $r->foodtruck->siteweb; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

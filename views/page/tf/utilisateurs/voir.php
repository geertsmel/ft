<div class="red">
<div class="row space-between">
        <h2>Utilisateurs</h2>
        <button class="btn-green"><a href="?section=utilisateurs&action=ajouter">Ajouter un utilisateur</a></button>
    </div>
    <?php if(count($utilisateurs) > 0) : ?>
        <table>
            <tr>
                <th>Login</th>
                <th>Rôle</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php foreach($utilisateurs as $u): ?>
            <tr>
                <td><?= $u->login; ?></td>
                <td><?= $u->role; ?></td>
                <td>
                    <a href="?section=utilisateurs&action=modifier&id=<?= $u->id?>">&#128394;</a>
                </td>
                <td>
                    <a href="?section=utilisateurs&action=supprimer&id=<?= $u->id?>">&#128465;</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p class="alert">Il n'y pas de utilisateurs</p>
    <?php endif; ?>
</div>
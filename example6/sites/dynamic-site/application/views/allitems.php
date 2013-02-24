<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
    </tr>
<?php foreach ($items as $item): ?>
    <tr>
        <td><?= $item->getId() ?></td>
        <td><?= $item->getName() ?></td>
    </tr>
<?php endforeach; ?>
</table>

<h1>List of Albums</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th colspan="2">Action</th>
    </tr>
    <?php foreach ($this->albums as $album) : ?>
        <tr>
            <td><?= htmlspecialchars($album['id']) ?></td>
            <td><?= htmlspecialchars($album['name']) ?></td>
            <td><a href="/albums/edit/<?=$album['id'] ?>">[Edit]</td>
            <td><a href="/albums/delete/<?=$album['id'] ?>">[Delete]</td>
        </tr>
    <?php endforeach ?>
</table>

<a href="/albums/create">[Create New]</a>

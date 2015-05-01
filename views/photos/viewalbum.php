<div class="add-photos-header">
    <h1 class="text-success">List of Photos</h1>
    <a href="/photos/add/<?= htmlspecialchars($this->albumId) ?>" class="btn btn-lg btn-success pull-right">Add Photos</a>
</div>
<div class="photos-wrapper">
    <?php foreach ($this->photos as $photo) : ?>
        <div class="photo-container">
            <a href="/photos/viewphoto/<?= htmlspecialchars($photo['id']) ?>">
                <img src="/<?= htmlspecialchars($photo['path']) ?>" alt=""/>
            </a>
        </div>
    <?php endforeach ?>
</div>
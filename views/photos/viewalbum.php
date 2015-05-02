<div class="add-photos-header">
    <h1 class="text-success">List of Photos</h1>
    <a href="/photos/add/<?= htmlspecialchars($this->albumId) ?>" class="btn btn-lg btn-success pull-right">Add Photos</a>
    <?php if($_SESSION['is_public']) : ?>
        <a href="/albums/makeprivate/<?= htmlspecialchars($this->albumId) ?>" class="btn btn-lg btn-warning pull-right">Make Private</a>
    <?php else : ?>
        <a href="/albums/makepublic/<?= htmlspecialchars($this->albumId) ?>" class="btn btn-lg btn-warning pull-right">Make Public</a>
    <?php endif; ?>
</div>
<div class="photos-wrapper">
    <?php if(count($this->photos) < 1) : ?>
        <h3 class="text-center text-danger">No photos in this album.</h3>
    <?php else : foreach ($this->photos as $photo) : ?>
        <div class="photo-container">
            <a href="/photos/viewphoto/<?= htmlspecialchars($photo['id']) ?>">
                <img src="/<?= htmlspecialchars($photo['path']) ?>" alt=""/>
            </a>
        </div>
        <?php endforeach ?>
    <?php endif ?>
</div>
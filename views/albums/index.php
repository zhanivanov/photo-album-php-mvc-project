<div class="create-album-header">
    <h1 class="text-success">List of Albums</h1>
    <a href="albums/create" class="btn btn-lg btn-success pull-right">Create Album</a>
</div>
<?php foreach ($this->albums as $album) : ?>
    <a href="photos/viewalbum/<?= htmlspecialchars($album['id']) ?>" id="album-link-<?= htmlspecialchars($album['id']) ?>" class="normal">
            <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <?= htmlspecialchars($album['name']) ?>
                        <span class="date-of-creation pull-right"><?= htmlspecialchars(date_format(date_create($album['created_on']), "d/M/Y")) ?></span>
                    </h3>
                    <a href="albums/delete/<?= $album['id'] ?>" class="big"><span class="delete-album pull-right"></span></a>
                    <a href="albums/edit/<?= $album['id'] ?>" class="big"><span class="edit-album pull-right"></span></a>
                </div>
                <div class="panel-body" id="album-wrapper">
                    <?= $this->getPhotosByAlbumId($album['id']); ?>
                    <?php if(empty($this->photos[0]) && empty($this->photos[1]) && empty($this->photos[2])) : ?>
                        <h3 class="text-center text-danger">No photos in this album.</h3>
                    <?php else : ?>
                        <?php if(empty($this->photos[0])) : ?>
                            <img src="/content/images/na.jpg" alt="img-not-available" class="album-img-cover"/>
                        <?php else : ?>
                            <img src="<?= htmlspecialchars($this->photos[0]['path']) ?>" alt="<?= htmlspecialchars($this->photos[0]['id']) ?>" class="album-img-cover"/>
                        <?php endif ?>
                        <?php if(empty($this->photos[1])) : ?>
                            <img src="/content/images/na.jpg" alt="img-not-available" class="album-imgs"/>
                        <?php else : ?>
                            <img src="<?= htmlspecialchars($this->photos[1]['path']) ?>" alt="<?= htmlspecialchars($this->photos[1]['id']) ?>" class="album-imgs"/>
                        <?php endif ?>
                        <?php if(empty($this->photos[2])) : ?>
                            <img src="/content/images/na.jpg" alt="img-not-available" class="album-imgs"/>
                        <?php else : ?>
                            <img src="<?= htmlspecialchars($this->photos[2]['path']) ?>" alt="<?= htmlspecialchars($this->photos[2]['id']) ?>" class="album-imgs"/>
                        <?php endif ?>
                    <?php endif ?>
                </div>
                </div>
            </div>
        </div>
    </a>
<?php endforeach ?>

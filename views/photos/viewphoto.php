<div class="photo-view-container">
    <img src="/<?= htmlspecialchars($this->photo['path']) ?>" alt=""/>
    <a href="/photos/delete/<?= $this->photo['id'] ?>" class="btn btn-block btn-danger">Delete</a>
</div>
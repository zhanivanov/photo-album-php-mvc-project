<?php if ($this->album) { ?>
<div class="form-container">
    <form class="form-horizontal" method="post" action="/albums/edit/<?= $this->album['id'] ?>">
        <fieldset>
            <legend class="text-success">Edit existing album</legend>
            <div class="form-group">
                <label for="name" class="col-lg-2 control-label">Album Name</label>
                <div class="col-lg-10">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Album Name" required value="<?= htmlspecialchars($this->album['name']) ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="/albums" type="reset" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-warning">Edit</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<?php } ?>
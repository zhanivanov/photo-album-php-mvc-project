<div class="form-container">
    <form class="form-horizontal" method="post" action="/albums/create">
        <fieldset>
            <legend class="text-success">Create new album</legend>
            <div class="form-group">
                <label for="name" class="col-lg-2 control-label">Album Name</label>
                <div class="col-lg-10">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Album Name" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="/albums" type="reset" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>
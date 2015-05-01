<div class="form-container">
    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend class="text-success">Upload new photo:</legend>
            <div class="form-group">
                <label for="name" class="col-lg-2 control-label">Choose Photo</label>
                <div class="col-lg-10">
                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" placeholder="Upload Photo" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="/albums" type="reset" class="btn btn-default">Cancel</a>
                    <input class="btn btn-success" type="submit" value="Upload Photo" name="submit">
                </div>
            </div>
        </fieldset>
    </form>
</div>
<div class="form-container">
    <form class="form-horizontal" action="/account/login" method="post">
        <fieldset>
            <legend>Login</legend>
            <div class="form-group">
                <label for="inputUsername" class="col-lg-2 control-label">Username</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="inputUsername" placeholder="Username" name="username" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                <div class="col-lg-10">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="/" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-success">Login</button>
                    <a href="/account/register" class="btn btn-primary btn-sm pull-right">Go to Register</a>
                </div>
            </div>
        </fieldset>
    </form>
</div>
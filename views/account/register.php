<div class="form-container">
    <form class="form-horizontal" action="/account/register" method="post">
      <fieldset>
        <legend>Register</legend>
          <div class="form-group">
              <label for="inputName" class="col-lg-2 control-label">Name</label>
              <div class="col-lg-10">
                  <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" required>
              </div>
          </div>
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
              <label for="inputConfirmPassword" class="col-lg-2 control-label">Confirm Password</label>
              <div class="col-lg-10">
                  <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password" name="confirmPassword" required>
              </div>
          </div>
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button type="reset" class="btn btn-default">Cancel</button>
            <button type="submit" class="btn btn-primary">Register</button>
            <a href="/account/login" class="btn btn-success btn-sm pull-right">Go to Login</a>
          </div>
        </div>
      </fieldset>
    </form>
</div>
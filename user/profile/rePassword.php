<div class="container-fluid p-5">
  <?php
  if (isset($_SESSION['user'])) {
    extract($_SESSION['user']);
  }
  ?>
  <main class="content">
    <div class="container-fluid p-0">
      <h1 class="h3 mb-3">Settings</h1>

      <div class="row">
        <div class="col-md-3 col-xl-2">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title mb-0">Profile Settings</h5>
            </div>

            <div class="list-group list-group-flush" role="tablist">
              <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
                Password
              </a>
              <a class="list-group-item list-group-item-action" href="?act=profile" role="tab">
                Account
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-9 col-xl-10">
          <div class="tab-content">
            <!-- <div class="tab-pane fade" id="password" role="tabpanel"> -->
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Password</h5>

                  <form method="post">
                    <div class="form-group">
                      <label for="inputPasswordCurrent">Current password</label>
                      <input type="password" name="password" class="form-control" id="inputPasswordCurrent" />
                      <small><a href="/login/resetPassword.php">Forgot your password?</a></small>
                    </div>
                    <div class="form-group">
                      <label for="inputPasswordNew">New password</label>
                      <input name="newPassword" type="password" class="form-control" id="inputPasswordNew" />
                    </div>
                    <div class="form-group">
                      <label for="inputPasswordNew2">Verify password</label>
                      <input type="password" name="newPass" class="form-control" id="inputPasswordNew2" />
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary">
                      Save changes
                    </button>
                  </form>
                  <?php
                  if (isset($_POST['submit'])) {
                    $password = substr(md5($_POST['password']), 0, 8);
                    $newPassword = $_POST['newPassword'];
                    $newPass = $_POST['newPass'];
                    $checkPass = loginCheckPass($password);
                    if (is_array($checkPass)) {
                      if ($newPassword === $newPass) {
                        loginUpdatePassword(substr(md5($newPassword), 0, 8), $email);
                        echo "thanh cong";
                      } else {
                        echo "password phai trung repassword";
                      }
                    } else {
                      echo "mat khau khong dung";
                    }
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
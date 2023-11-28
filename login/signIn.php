﻿<?php 
session_start();
include "../dao/login/login.php";
if (isset($_POST['signIn'])){
  $email = $_POST['email'];
  $password = substr(md5($_POST['password']),0,8);
  $checkUser = loginUser($email, $password);
  if (is_array($checkUser)){
    extract($checkUser);
    if(isset($status) && $status == 0){
          $_SESSION['user'] = $checkUser;
          header("location: ../user/");
    } else {
      // "tên tài khoản hoặc mật khẩu không đúng"
      $isSuccessLogin = 1 ;
    }
  }else{
    echo "Tài khoản của bạn đã bị khóa";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>Sign In - AppStack - Admin &amp; Dashboard Template</title>

    <link rel="preconnect" href="//fonts.gstatic.com/" crossorigin="" />

    <link href="../admin/css/classic.css" rel="stylesheet" />
  </head>

  <body>
    <main class="main d-flex w-100">
      <div class="container d-flex flex-column">
        <div class="row h-100">
          <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">
              <div class="text-center mt-4">
                <h1 class="h2">Welcome back</h1>
                <p class="lead">Sign in to your account to continue</p>
              </div>

              <div class="card">
                <div class="card-body">
                  <div class="m-sm-4">
                    <div class="text-center">
                      <img
                        src="../admin/img/avatars/avatar.jpg"
                        alt="Chris Wood"
                        class="img-fluid rounded-circle"
                        width="132"
                        height="132"
                      />
                    </div>
                    <form method="post">
                      <div class="form-group">
                        <label>Email</label>
                        <input
                          class="form-control form-control-lg"
                          type="email"
                          name="email"
                          required
                          placeholder="Enter your email"
                        />
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input
                          class="form-control form-control-lg"
                          type="password"
                          name="password"
                          required
                          placeholder="Enter your password"
                        />
                        <div class="d-flex mt-2">
                          <a href="resetPassword.php">Forgot password?</a>
                          <a href="signUp.php" name="" class="ml-auto"
                            >You don't have account? Sign up?</a
                          >
                        </div>
                      </div>
                      <div>
                        <div
                          class="custom-control custom-checkbox align-items-center"
                        >
                          <input
                            type="checkbox"
                            class="custom-control-input"
                            value="remember-me"
                            name="remember-me"
                            checked=""
                          />
                          <label class="custom-control-label text-small"
                            >Remember me next time</label
                          >
                        </div>
                      </div>
                      <div class="text-center mt-3">
                        <!-- <a href="../user/" class="btn btn-lg btn-primary"
                          >Sign in</a
                        > -->

                        <button type="submit" name="signIn" class="btn btn-lg btn-primary">Sign in</button>
                      </div>
                      <?php if (isset($isSuccessLogin)) echo $isSuccessLogin;?>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>

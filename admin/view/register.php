<?php

  require_once('../../includes/config.php');
  require_once('../../includes/dispErrors.php');
  if($user->is_logged())
  {
    header('Location: index.php');
  }

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>NBA Admin - Register</title>

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

    

  </head>

  <body class="bg-dark">

    <?php

      if(isset($_POST['submit']))
      {
        extract($_POST);

        if($userName == '')
        {
          $error[] = 'Please enter username';
        }
        if($userEmail == '')
        {
          $error[] = 'Please enter your e-mail';
        }
        if($userPassword == '')
        {
          $error[] = 'Please enter password';
        }
        if($passwordConfirm == '')
        {
          $error[] = 'Please confirm the password!';
        }
        if($userPassword != $passwordConfirm)
        {
          $error[] = 'Passwords do not match!';
        }

        if(!isset($error))
        {
          $hashedPassword = password_hash($userPassword, PASSWORD_BCRYPT);

          try
          {
            $selUser = $db->prepare('INSERT INTO users (userName, userEmail, userPassword) VALUES (:userName, :userEmail, :userPassword)');
            $selUser->execute(array(
              ':userName' => $userName,
              ':userEmail' => $userEmail,
              ':userPassword' => $hashedPassword
            ));
            header('Location: login.php');
            exit;
          }
          catch(PDOException $e)
          {
            echo $e->getMessage();
          }
        }
      }
      if(isset($error))
      {
        foreach($error as $err)
        {
          echo '<p class="alert alert-danger error">' . $err . '</p>';
        }
      }

?>
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Register an Account</div>
        <div class="card-body">
          <form action='' method='post'>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="username" class="form-control" placeholder="Username" required="required" name="userName" value="<?php if(isset($error)) {echo $_POST['userName'];}?>" autofocus="autofocus">
                    <label for="username">Username</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" name="userEmail" value="<?php if(isset($error)){ echo $_POST['userEmail'];} ?>">
                <label for="inputEmail">Email address</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="userPassword" value="<?php if(isset($error)) {echo $_POST['userPassword'];} ?>" required="required">
                    <label for="inputPassword">Password</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required" name="passwordConfirm" value="<?php if(isset($error)) { echo $_POST['passwordConfirm'];} ?>">
                    <label for="confirmPassword">Confirm password</label>
                  </div>
                </div>
              </div>
            </div>
            <input type="submit" name='submit' value='Register'  class="btn btn-primary btn-block">
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="login.php">Login Page</a>
            <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
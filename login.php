<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /login");
    } else {
      $message = 'Datos no validos';
    }
  }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/web-fonts-with-css/css/fontawesome-all.css" />
</head>

<?php if(!empty($message)): ?>
  <p> <?= $message ?></p>
<?php endif; ?>

<div class="container">
    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" method="POST">
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Usuario" required autofocus>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
            <div id="remember" class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Recuerdame
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
        </form>
        <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
        <a href="signup.php" class="forgot-password">¿No tienes cuenta? Registrate</a>
    </div>
</div>

</html>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="/js/main.js"></script>
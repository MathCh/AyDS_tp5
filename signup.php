<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['username']) 
  && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['dni']) && 
  !empty($_POST['phone']) && !empty($_POST['address']) && !empty($_POST['obra'])) {
    $sql = "INSERT INTO users (name, surname,username, email, password, dni, phone, address, obra) VALUES (:name, :surname,:username, :email, :password, :dni, :phone, :address, :obra)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':surname', $_POST['surname']);
    $stmt->bindParam(':username', $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':dni', $_POST['dni']);
    $stmt->bindParam(':phone', $_POST['phone']);
    $stmt->bindParam(':address', $_POST['address']);
    $stmt->bindParam(':obra', $_POST['obra']);

    if ($stmt->execute()) {
      $message = 'Usuario creado correctamente';
    } else {
      $message = 'El usuario no se ha podido crear';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SignUp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/web-fonts-with-css/css/fontawesome-all.css" />
  </head>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <div class="container" id="formularioUsuario">
    <h4 class="card-header">Registro</h4>
      <form id="f" action="signup.php" method="POST">
        <div class="form-group">
          <div class="row">
            <div class="col">
              <input class="form-control" name="name" type="text" placeholder="Nombre" required>
            </div>
            <div class="col">
              <input class="form-control" name="surname" type="text" placeholder="Apellido" required>
            </div>
        </div>
      </div>
      <div class="form-group">
        <input class="form-control" name="username" type="text" placeholder="Nombre de usuario" required>
        <small class="form-text text-muted">*Caracteres especiales no son admitidos.</small>
      </div>
      <div class="form-group">
        <input class="form-control" name="email" type="email" placeholder="Correo electronico" required>
      </div>
      <div class="form-group">
        <input class="form-control" name="password" type="password" placeholder="Contraseña" required>
        <small class="form-text text-muted">*Al menos 6 caracteres de longitud.</small>
      </div>
      <div class="form-group row">
      <div class="col">
        <input class="form-control" name="dni" type="number" placeholder="DNI" required>
        <small class="form-text text-muted">*Ingrese el DNI sin puntos.</small>
      </div>
        <div class="col">
          <select class="form-control" type="text" name="obra">
            <option value="" disabled selected>Obra Social</option>
            <option value="obra1">obra1</option>
            <option value="obra2">obra2</option>
            <option value="obra3">obra3</option>
            <option value="obra4">obra4</option>
            <option value="obra5">obra5</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <input class="form-control" name="phone" type="number" placeholder="Numero de Telefono" required>
      </div>
      <div class="form-group">
        <input class="form-control" name="address" type="text" placeholder="Domicilio" required>
      </div>
      <div class="row justify-content-end">
        <button class="btn btn-info" id="btnRegistrar">Registrarme</button>
      </div>
    </form>
    <div class="card-footer">
      <a href="login.php" class="forgot-password">Ya tienes cuenta. Logueate aquí</a>
    </div>
  </div>
</html>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="/js/main.js"></script>
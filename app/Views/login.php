<?php
//para obtener la sesion
$user_session = session();

//si en caso la sesion sigue activa (pendiente)
// if ($user_session != null) {

// }
?>

<!DOCTYPE html>
<html>

<head>
<link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/iconoHotel.png" rel="stylesheet" />
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    body {
      background-image: url('<?php echo base_url() ?>assets/img/DesenfoqueHotel.avif');
      background-size: cover;
      background-position: center;
    }

    .login-container {
      max-width: 400px;
      margin: 0 auto;
      margin-top: 150px;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .login-container h4 {
      margin-bottom: 20px;
      text-align: center;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      font-weight: bold;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .btn-login {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-login:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <h4>Iniciar sesión</h4>
    <form method="post" action="<?php echo base_url(); ?>usuario/valida">
      <div class="form-group">
        <label for="usuario">Usuario:</label>
        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su usuario" required>
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
      </div>
      <button type="submit" class="btn btn-login my-3">Iniciar sesión</button>

      <!-- validar errores -->
      <?php if (isset($validation)) { ?>
        <div class="alert alert-danger">
          <?php echo $validation->listErrors(); ?>
        </div>
      <?php } ?>

      <?php if (isset($error)) { ?>
        <div class="alert alert-danger">
          <?php echo $error; ?>
        </div>
      <?php } ?>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
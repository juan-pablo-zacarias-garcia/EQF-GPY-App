   
<main class="form-signin">
  <h1><?php echo $mensaje ?></h1>
  <form action="../login/login.php?action=validate" method="POST">    
    <h1 class="h3 mb-3 fw-normal">INICIE SESIÓN</h1>

    <div class="form-floating">
      <input type="email" name="correo" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Correo Electrónico</label>
    </div>
    <div class="form-floating">
      <input type="password" name="contrasena" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Contraseña</label>
    </div>    
    <input class="w-100 btn btn-lg btn-primary" type="submit" name="enviar" value="ingresar">
    <a href="../login/login.php?action=forget">¿Olvidó su contraseña?</a>
    <p class="mt-5 mb-3 text-muted">&copy; Enrique Amate 2021</p>
  </form>
</main>


    
  
<?php
if (isset($_POST['type'])) {
  $type = $_POST['type'];
  if ($type == 'user') {
   ?>
    <form action="login.php" method="POST">
      <div class="form-floating">
        <input type="text" class="form-control" name="user" id="floatingInput" placeholder="Username">
        <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
      <div class="text-center">
        <p>Don't have an account? <a href="register.php">Register</a></p>
      </div>
      <button class="btn btn-primary w-100 py-2" type="submit" name="store_session" value="Login">Submit</button>
    </form>
    <?php
  } elseif ($type == 'associate') {
   ?>
    <form action="login.php" method="POST">
      <div class="form-floating">
        <input type="text" class="form-control" name="associate_user" id="floatingInput" placeholder="Associate Username">
        <label for="floatingInput">Associate Username</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="associate_password" id="floatingPassword" placeholder="Associate Password">
        <label for="floatingPassword">Associate Password</label>
      </div>
      <div class="text-center">
        <p>Don't have an account? <a href="register.php">Register</a></p>
      </div>
      <button class="btn btn-primary w-100 py-2" type="submit" name="store_session" value="Login">Submit</button>
    </form>
    <?php
  }
}
?>
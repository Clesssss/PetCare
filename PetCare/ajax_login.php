<?php
// Include the connection file
include('connection.php');
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
// Check if the submit button is clicked
if (isset($_POST['store_session'])) {
    $type = $_POST['type'];

    // Check if the type is user or associate
    if ($type == 'user') {
        $username = $_POST['user'];
        $password = $_POST['password'];

        // Prepare the query
        $query = "SELECT user_id, pass FROM user WHERE username=:username";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the password matches
        if ($row && password_verify($password, $row['pass'])) {
            // Login successful, set the session variables
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $username;
            echo 'Login successful!';
        } else {
            echo 'Invalid username or password!';
        }
    } elseif ($type == 'associate') {
        $associate_username = $_POST['associate_user'];
        $associate_password = $_POST['associate_password'];

        // Prepare the query
        $query = "SELECT associate_id, pass FROM associate WHERE username=:associate_username";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':associate_username', $associate_username, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the password matches
        if ($row && password_verify($associate_password, $row['pass'])) {
            // Login successful, set the session variables
            $_SESSION['associate_id'] = $row['associate_id'];
            $_SESSION['associate_name'] = $associate_username;
            echo 'Login successful!';
        } else {
            echo 'Invalid associate username or password!';
        }
    }
}
?>
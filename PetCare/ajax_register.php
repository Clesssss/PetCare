<?php
include('connection.php');

if (isset($_POST['type'])) {
    $type = $_POST['type'];
    if ($type == 'user') {
?>
    <form action="register.php" method="POST">
      <div class="form-floating">
        <input type="text" class="form-control" name="user" id="floatingInput" placeholder="Username" required>
        <label for="floatingInput">Username</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
        <label for="floatingPassword">Password</label>
      </div>
      <div class="text-center">
        <p>Already have an account? <a href="login.php">Login</a></p>
      </div>
      <button class="btn btn-primary w-100 py-2" type="submit">Submit</button>
    </form>
<?php
    } elseif ($type == 'associate') {
        // Fetch job options from database
        $job_query = "SELECT job_id, name FROM job";
        $stmt = $conn->prepare($job_query);
        $stmt->execute();
        $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <form action="register.php" method="POST">
      <div class="form-floating">
        <input type="text" class="form-control" name="associate_user" id="floatingInput" placeholder="Associate Username" required>
        <label for="floatingInput">Associate Username</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="associate_password" id="floatingPassword" placeholder="Associate Password" required>
        <label for="floatingPassword">Associate Password</label>
      </div>
      <div class="form-floating">
        <input type="email" class="form-control" name="associate_email" id="floatingEmail" placeholder="Email" required>
        <label for="floatingEmail">Email</label>
      </div>
      <div class="form-floating">
        <select class="form-control" name="associate_job" id="floatingJob" required>
          <option value="" disabled selected>Select Job</option>
          <?php foreach ($jobs as $job) { ?>
            <option value="<?= $job['job_id'] ?>"><?= $job['name'] ?></option>
          <?php } ?>
        </select>
        <label for="floatingJob">Job</label>
      </div>
      <div class="text-center">
        <p>Already have an account? <a href="login.php">Login</a></p>
      </div>
      <button class="btn btn-primary w-100 py-2" type="submit">Submit</button>
    </form>
<?php
    }
}
?>
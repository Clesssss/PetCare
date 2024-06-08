<?php
    session_start();
    
    if (isset($_POST['store_session'])) {
    include('connection.php');
    
    if (isset($_POST['store_session'])) {
    if (isset($_POST['user'])) {
        $username = $_POST['user'];
        $password = $_POST['password'];
        $type = 'user';

        // Prepare the query
        $query = "SELECT user_id, pass FROM user WHERE username=:username";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the password matches
        if ($row && $row['pass'] === $password) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $_POST['user'];
            header('location: index.php');
            exit();
        } else {
            $warning = 'Login Gagal!';
        }
    } elseif (isset($_POST['associate_user'])) {
        $associate_username = $_POST['associate_user'];
        $associate_password = $_POST['associate_password'];
        $type = 'associate';

        // Prepare the query
        $query = "SELECT associate_id, pass FROM associate WHERE username=:associate_username";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':associate_username', $associate_username, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the password matches
        if ($row && $row['pass'] === $associate_password) {
            $_SESSION['associate_id'] = $row['associate_id'];
            $_SESSION['associate_name'] = $_POST['associate_user'];
            header('location: index.php');
            exit();
        } else {
            $warning = 'Login Gagal!';
        }
    }
}
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Login</title>
    <style>
        .active {
            background-color: #333; /* or any other darker color */
            color: #fff; /* optional: change text color to white */
        }
        html, body {
            height: 100%;
        }

        .form-signin {
            max-width: 330px;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }   

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
  <a href="index.php" class="btn btn-sm btn-outline-secondary mb-3">
    <i class="bi bi-arrow-left"></i> Back
  </a>
  <h1 class="h3 mb-3 fw-normal">Log in</h1>
  <div class="btn-group w-100 mb-3">
  <button class="btn btn-outline-secondary active w-50" id="user-btn">User</button>
  <button class="btn btn-outline-secondary w-50" id="associate-btn">Associate</button>
</div>
  <div id="login-form-container">
  </div>
  <?php
    if(isset($warning))
    {
 ?>
  <div class="alert alert-danger" role="alert">
    <b><?php echo $warning;?></b>
  </div>
  <?php
    }
 ?>
</main>

<script>
  $(document).ready(function() {
    // Load user login form by default
    $.ajax({
      type: "POST",
      url: "ajax_login.php",
      data: { type: "user" },
      success: function(html) {
        $("#login-form-container").html(html);
      }
    });

    $("#user-btn, #associate-btn").click(function() {
    var type = $(this).attr("id") === "user-btn" ? "user" : "associate";
    $.ajax({
      type: "POST",
      url: "ajax_login.php",
      data: { type: type },
      success: function(html) {
        $("#login-form-container").html(html);
      }
    });

    // Toggle button colors
    $("#user-btn, #associate-btn").removeClass("active");
    $(this).addClass("active");

    // Submit login form via AJAX
    $("form").submit(function(event) {
      event.preventDefault();
      var formData = $(this).serialize();
      var type = $(this).find("input[name='type']").val();
      $.ajax({
        type: "POST",
        url: "ajax_login.php",
        data: formData + "&type=" + type,
        success: function(response) {
          if (response === 'Login successful!') {
            window.location.href = 'index.php';
          } else {
            $("#warning").html(response);
          }
        }
      });
    });
  });
  });
  
</script>
    
</body>
</html>
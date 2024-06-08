<?php
session_start();
include("connection.php");

if (isset($_POST['user']) || isset($_POST['associate_user'])) {
    if (isset($_POST['user'])) {
        $username = $_POST['user'];
        $password = $_POST['password']; // Plain text password (not recommended)

        // Check if username already exists
        $check_query = "SELECT * FROM user WHERE username = :username";
        $stmt = $conn->prepare($check_query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Username already taken. Please choose another username.";
        } else {
            // Insert new user
            $sql = "INSERT INTO user (username, pass) VALUES (:username, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            // Set session variables
            $_SESSION['user_id'] = $conn->lastInsertId();
            $_SESSION['user_name'] = $username;

            echo "success";
        }
    } elseif (isset($_POST['associate_user'])) {
        $associate_username = $_POST['associate_user'];
        $associate_password = $_POST['associate_password']; // Plain text password (not recommended)
        $associate_email = $_POST['associate_email'];
        $associate_job = $_POST['associate_job'];

        // Check if associate username already exists
        $check_query = "SELECT * FROM associate WHERE username = :associate_username";
        $stmt = $conn->prepare($check_query);
        $stmt->bindParam(':associate_username', $associate_username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Username already taken. Please choose another username.";
        } else {
            // Insert new associate
            $sql = "INSERT INTO associate (username, pass, email, job_id) VALUES (:associate_username, :associate_password, :associate_email, :associate_job)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':associate_username', $associate_username);
            $stmt->bindParam(':associate_password', $associate_password);
            $stmt->bindParam(':associate_email', $associate_email);
            $stmt->bindParam(':associate_job', $associate_job);
            $stmt->execute();

            // Set session variables
            $_SESSION['associate_id'] = $conn->lastInsertId();
            $_SESSION['associate_name'] = $associate_username;

            echo "success";
        }
    }
    exit();
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
    <title>Register</title>
    <style>
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
    <h1 class="h3 mb-3 fw-normal">Register</h1>
    <div class="btn-group w-100 mb-3">
      <button class="btn btn-outline-secondary active w-50" id="user-btn">User</button>
      <button class="btn btn-outline-secondary w-50" id="associate-btn">Associate</button>
    </div>
    <div id="login-form-container"></div>
    <div class="alert alert-danger d-none" role="alert" id="warning"></div>
  </main>
  <script>
    $(document).ready(function() {
      // Load user registration form by default
      $.ajax({
        type: "POST",
        url: "ajax_register.php",
        data: { type: "user" },
        success: function(html) {
          $("#login-form-container").html(html);
        }
      });

      $("#user-btn, #associate-btn").click(function() {
        var type = $(this).attr("id") === "user-btn" ? "user" : "associate";
        $.ajax({
          type: "POST",
          url: "ajax_register.php",
          data: { type: type },
          success: function(html) {
            $("#login-form-container").html(html);
          }
        });

        // Toggle button colors
        $("#user-btn, #associate-btn").removeClass("active");
        $(this).addClass("active");
      });

      // Submit registration form via AJAX
      $(document).on('submit', 'form', function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
          type: "POST",
          url: "register.php",
          data: formData,
          success: function(response) {
            if (response === 'success') {
              window.location.href = 'index.php';
            } else {
              $("#warning").text(response).removeClass('d-none');
            }
          }
        });
      });
    });
  </script>
</body>
</html>
<?php
    session_start();
    include("connection.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Main</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            
        </script>
        <style>
           
            :root {
                --jumbotron-padding-y: 3rem;
            }

            .jumbotron {
                padding-top: var(--jumbotron-padding-y);
                padding-bottom: var(--jumbotron-padding-y);
                margin-bottom: 0;
                background-color: #fff;
            }
            @media (min-width: 768px) {
                .jumbotron {
                    padding-top: calc(var(--jumbotron-padding-y) * 2);
                    padding-bottom: calc(var(--jumbotron-padding-y) * 2);
                }
            }

            .jumbotron p:last-child {
                margin-bottom: 0;
            }

            .jumbotron-heading {
                font-weight: 300;
            }

            .jumbotron .container {
                max-width: 40rem;
            }
            .box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05); }
            a:hover {
                text-decoration: underline;
            }
            a {
                text-decoration: none;
            }
            
        </style>
    </head>
    <body>
        <?php include("navbar.php"); ?>
        <main role="main">
            <section class="jumbotron text-center">
                <div class="container">

                </div>
            </section>
            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">
                        
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
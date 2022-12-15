<!-- below HTML -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BloodBank</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonmous">
    <!-- Javascript for bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- custom css -->
    <link rel="stylesheet" href="/static/styles/style.css">
    <style>
        .navbar {
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            background-color: #ffa2ae;
        }
    </style>
</head>


<body>
    <!----------------------------- nav -------------------------------  -->
    <nav class="navbar navbar-expand-lg" style="background-color:#d20f39">
        <div class="container">
            <a class="navbar-brand" href="/project">BloodBank</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/project/donate.php">Donate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/project/search.php">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/project/about.php">About</a>
                    </li>
                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    // php code
                    if ($_SESSION['user_logged']) {
                        echo '<li class="nav-item"><a class="nav-link active" href="/project/user.php">Profile</a></li>';
                    } elseif ($_SESSION['admin_logged']) {
                        echo '<li class="nav-item"><a class="nav-link active" href="/project/admin.php">Admin </a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link active" href="/project/login.php">Login</a></li>';
                    }
                    // php code
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!----------------------------- start ------------------------------  -->
    <div class="container bootstrap snippets bootdey">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right" style="margin-top:10px;">
                    <div class="col-md-10 col-md-offset-1 pull-right">

                        <!-- 404 -->
                        <img class="img-error" src="https://bootdey.com/img/Content/fdfadfadsfadoh.png">
                        <h2>404 Not Found</h2>
                        <p>Sorry, an error has occured, Requested page not found!</p>
                        <div class="error-actions">
                            <a href="/" class="btn btn-warning btn-lg">
                                <span class="glyphicon glyphicon-arrow-left"></span>
                                Back Home
                            </a>

                            <?php


                            echo "<hr>\n<h1>Session</h1>";
                            echo '<pre>';
                            print_R($_SESSION);
                            echo '</pre>';

                            echo "<hr>\n<h1>Router</h1>";
                            echo '<pre>';
                            print_R($_ROUTER);
                            echo '</pre>';

                            echo "<hr>\n<h1>Get</h1>";
                            echo '<pre>';
                            print_R($_GET);
                            echo '</pre>';

                            echo "<hr>\n<h1>POST</h1>";
                            echo '<pre>';
                            print_R($_POST);
                            echo '</pre>';

                            echo "<h1>Information!</h1>";
                            echo "<hr>\n<h1>Server</h1>";
                            echo '<pre>';
                            print_R($_SERVER);
                            echo '</pre>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




</body>

</html>
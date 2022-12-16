<?php
session_start();
require_once('./db/config.php');
?>

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
    <link rel="stylesheet" href="/project/static/styles/style.css">
    <link href="/project/asset/favicon.png" rel="icon" type="image/png" />
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
                    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin']) {
                        echo '<li class="nav-item"><a class="nav-link active" href="/project/user.php">Profile</a></li>';
                        echo '<li class="nav-item"><a class="nav-link active" href="/project/logout.php">Logout</a></li>';
                    } elseif (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin']) {
                        echo '<li class="nav-item"><a class="nav-link active" href="/project/admin.php">Admin </a></li>';
                        echo '<li class="nav-item"><a class="nav-link active" href="/project/logout.php">Logout</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link active" href="/project/login.php">Login</a></li>';
                    }
                    // php code
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h3 class="mt-4">Donate Blood</h3>
        <p mb-1>
            Across Bangladesh, every day there remains an urgent need for all types of blood groups. Especially donors with rare blood groups such as O Negative, B Negative and A Negative are in high demand. Your timely response is essential to the supply of healthy blood for the massive daily demand we face.
        </p>
        <p mb-1>
            Your donation can save the lives of many, make a difference or simply make you feel great about your contribution to humanity. Whatever your reason, whatever your motivation we welcome you to learn more about eligibility and benefits of donating blood with a trusted organization like us.
        </p>
        <p mb-1>
            Find out more about local blood drives and BDRCS campaigns near you. Donate blood, save lives.
        </p>
        <p mb-1>
            Hotline: <strong>0181145852</strong>4 (9.00 AM to 5.00 PM)
        </p>
        <!--  -->
        <h3 class="mt-4">Make an appoinment to donate blood on our bloodbank</h3>
        <form class="mt-4" action="" method="POST">
            <!--  -->
            <div class="mb-3">
                <label for="" class="">Blood Group</label>
                <input type="email" name="abc" class="form-control" id="">
            </div>
            <!--  -->
            <div class="mb-3">
                <label for="" class="">Date</label>
                <input type="date" class="form-control" id="">
            </div>
            <!--  -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>

</body>

</html>
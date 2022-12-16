<?php
// initialize the session
session_start();

// exit if user logged in
if (isset($_SESSION["user_loggedin"]) && $_SESSION["user_loggedin"] === true) {
    // redirect to previous page
    if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
        $BACK = $_SERVER['HTTP_REFERER'];
        header("location: $BACK");
    } else {
        header('location: /project');
    }
    exit;
}

// exit if admin logged in
if (isset($_SESSION["admin_loggedin"]) && $_SESSION["admin_loggedin"] === true) {
    // redirect to previous page
    if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
        $BACK = $_SERVER['HTTP_REFERER'];
        header("location: $BACK");
    } else {
        header('location: /project/');
    }
    exit;
}


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
    <!-- Font Awosome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                        echo '<li class="nav-item"><a class="nav-link active" href="/project/register.php">Join Today </a></li>';
                    }
                    // php code
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <pre>
        <?php
        // print_r($_SERVER);
        ?>
    </pre>
    <!----------------------------- form ------------------------------  -->

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="/project/asset/banner-login.png" class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign in</p>
                    <!-- <form action="" method="post"> -->
                    <form action="/project/controller/handle-login.php" method="post">
                        <!--  -->

                        <?php
                        if (isset($_SESSION['login_err']) && !empty($_SESSION['login_err'])) {
                            echo '<div class="alert alert-danger">' . $_SESSION['login_err'] . '</div>';
                            unset($_SESSION['login_err']);
                        } else {
                        }
                        ?>
                        <!--  -->
                        <div class="d-flex flex-row align-items-center mb-2">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="email" name="email" class="form-control" placeholder="example@email.com" required />
                                <label class="form-label" for="email">User Email</label>
                            </div>
                        </div>
                        <!--  -->
                        <div class="d-flex flex-row align-items-center mb-2">
                            <i class="fa fa-lock fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input type="password" name="password" id="pass" class="form-control" />
                                <label class="form-label" for="form3Example4c">User Password</label>
                            </div>
                        </div>
                        <!--  -->
                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <i class="fas fa-bolt fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                                <input class="form-check-input" type="checkbox" name="admin" value="True" />
                                <label class="form-check-label" for="admin"> Login Admin </label>
                            </div>
                            <a id='forgot_password' href="#!">Forgot password?</a>
                        </div>

                        <!-- Submit button -->
                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button type="submit" class="btn btn-primary btn-lg">Log in</button>
                        </div>
                    </form>
                    <!--  -->
                    <div class="d-flex flex-row align-items-center m-2 mt-4">
                        <i class="fas fa-hand fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            Does not have a account ?
                            <a href="/project/register.php" class="link-primary">Join Today</a>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <script>
        "use strict";
        const forgot_password = document.getElementById('forgot_password');
        forgot_password.addEventListener('click', () => {
            alert('This feature not implemented for this project(yet) :(');
        })
    </script>
</body>

</html>
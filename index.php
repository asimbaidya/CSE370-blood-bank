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
                    if ($_SESSION['user_loggedin']) {
                        echo '<li class="nav-item"><a class="nav-link active" href="/project/user.php">Profile</a></li>';
                        echo '<li class="nav-item"><a class="nav-link active" href="/project/logout.php">Logout</a></li>';
                    } elseif ($_SESSION['admin_loggedin']) {
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

    <!----------------------------- slides ------------------------------  -->
    <div class="container mt-2">
        <?php
        //   testing
        echo "<hr>\n<h1>get</h1>";
        echo '<pre>';
        print_r($_SESSION);
        echo "</pre>\n<hr>";
        ?>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5" aria-label="Slide 6"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="6" aria-label="Slide 7"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="7" aria-label="Slide 8"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="8" aria-label="Slide 9"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="9" aria-label="Slide 10"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="/project/asset/slides/slide1.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/project/asset/slides/slide2.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/project/asset/slides/slide3.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/project/asset/slides/slide4.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/project/asset/slides/slide5.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/project/asset/slides/slide6.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/project/asset/slides/slide7.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/project/asset/slides/slide8.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/project/asset/slides/slide9.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/project/asset/slides/slide10.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
            </div>
            <!-- END of Slides -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</body>

</html>
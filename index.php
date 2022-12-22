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
    <link rel="stylesheet" href="/static/styles/style.css">
    <link href="/asset/favicon.png" rel="icon" type="image/png" />
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
            <a class="navbar-brand fs-1 fs-1" href="/">BloodBank</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link fs-2 active" aria-current="page" href="/donate.php">Donate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-2 active" href="/search.php">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-2 active" href="/about.php">About</a>
                    </li>
                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    // php code
                    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin']) {
                        echo '<li class="nav-item"><a class="nav-link fs-2 active" href="/user.php">Profile</a></li>';
                        echo '<li class="nav-item"><a class="nav-link fs-2 active" href="/logout.php">Logout</a></li>';
                    } elseif (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin']) {
                        echo '<li class="nav-item"><a class="nav-link fs-2 active" href="/admin.php">Admin </a></li>';
                        echo '<li class="nav-item"><a class="nav-link fs-2 active" href="/logout.php">Logout</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link fs-2 active" href="/login.php">Login</a></li>';
                    }
                    // php code
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!----------------------------- slides ------------------------------  -->
    <div class="container">
        <?php

        if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
            echo <<<ALERT
            <div class="alert alert-success mt-4" role="alert">
                $msg
            </div>
            ALERT;
            unset($_SESSION['msg']);
        }
        ?>



    </div>
    <div class="container mt-2">
        <div id="carousel_slides" class="carousel carousel-fade carousel-dark slide " data-bs-ride="carousel">
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
                    <img src="/asset/slides/slide1.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/asset/slides/slide2.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/asset/slides/slide3.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/asset/slides/slide4.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/asset/slides/slide5.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/asset/slides/slide6.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/asset/slides/slide7.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/asset/slides/slide8.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/asset/slides/slide9.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="slide_reference"><a style="text-decoration: none;" href="https://stanfordbloodcenter.org/">🔗slide courtesy</a></h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="/asset/slides/slide10.png" class="d-block w-100" alt="...">
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
    <!----------------------------- Footers -----------------------------  -->
    <div class="b-example-divider"></div>
    <div class="container">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
            <div class="col mb-3">
                <a href="/" class="d-flex align-items-center mb-3 link-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32">
                        <use xlink:href="#bootstrap" />
                    </svg>
                </a>
                <p class="text-muted">&copy;2022</p>
            </div>

            <div class="col mb-3"></div>

            <div class="col mb-3">
                <h5>Section</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-muted">Home</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-muted">Features</a>
                    </li>
                </ul>
            </div>

            <div class="col mb-3">
                <h5>Section</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-muted">Home</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-muted">Features</a>
                    </li>
                </ul>
            </div>

            <div class="col mb-3">
                <h5>Section</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-muted">Home</a>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-muted">FAQs</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 text-muted">About</a>
                    </li>
                </ul>
            </div>
        </footer>
    </div>

    <!---------------------------- javascript ---------------------------  -->
    <script>
        const myCarouselElement = document.querySelector('#carousel_slides')
        const carousel = new bootstrap.Carousel(myCarouselElement, {
            interval: 1000,
            wrap: true,
            keyboard: true,
            ride: true,
            touch: true,
        })
    </script>
</body>

</html>
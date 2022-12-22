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
            <a class="navbar-brand fs-1" href="/">BloodBank</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fs-2" aria-current="page" href="/donate.php">Donate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fs-2" href="/search.php">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fs-2" href="/about.php">About</a>
                    </li>
                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    // php code
                    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin']) {
                        echo '<li class="nav-item"><a class="nav-link active fs-2" href="/user.php">Profile</a></li>';
                        echo '<li class="nav-item"><a class="nav-link active fs-2" href="/logout.php">Logout</a></li>';
                    } elseif (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin']) {
                        echo '<li class="nav-item"><a class="nav-link active fs-2" href="/admin.php">Admin </a></li>';
                        echo '<li class="nav-item"><a class="nav-link active fs-2" href="/logout.php">Logout</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link active fs-2" href="/login.php">Login</a></li>';
                    }
                    // php code
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Abouts  -->

    <div class="container">
        <!-- <div class="shadow-lg p-3 mb-5 bg-body rounded">Larger shadow</div> -->
        <div class="mt-4">
            <details class="faq shadow-lg p-1  ps-4 mb-2 bg-body rounded">
                <summary class="faq-question">What is this site about ?</summary>
                <span class="faq-ans">
                    The purpose of this web site is to help people finde blood when they need!
                </span>
            </details>
            <details class="faq shadow-lg p-1 ps-4 mb-2 bg-body rounded">
                <summary class="faq-question">chick to see er used for this db!</summary>
                <span class="faq-ans">
                    <div class="text-center">
                        <img src="/asset/er.png" class="rounded" alt="Could not load ER image">
                    </div>
                </span>
            </details>
            <details class="faq shadow-g p-1 ps-4 mb-2 bg-body rounded">
                <summary class="faq-question">chick to see schema used for this db!</summary>
                <span class="faq-ans">
                    <div class="text-center">
                        <img src="/asset/schema.png" class="rounded" alt="Could not load Schema image">
                    </div>
                </span>
            </details>
            <details class="faq shadow-lg p-1  ps-4 mb-2 bg-body rounded">
                <summary class="faq-question">What frotn library used to build this website?</summary>
                <span class="faq-ans">
                    We used vanijs HTML and CSS with little help of Bootstrap framework
                </span>
            </details>
            <details class="faq shadow-lg p-1  ps-4 mb-2 bg-body rounded">
                <summary class="faq-question">In what langauge backend handled</summary>
                <span class="faq-ans">
                    For backend, we used php!
                </span>
            </details>
            <details class="faq shadow-lg p-1  ps-4 mb-2 bg-body rounded">
                <summary class="faq-question">Do we know php</summary>
                <span class="faq-ans">
                    No No No No No No No No No No No No No No No No No No No No No
                </span>
            </details>
            <details class="faq shadow-lg p-1  ps-4 mb-2 bg-body rounded">
                <summary class="faq-question">Did we used php?</summary>
                <span class="faq-ans">
                    Yes Yes Yes Yes Yes Yes Yes Yes Yes YesYes
                </span>
            </details>
            <details class="faq shadow-lg p-1  ps-4 mb-2 bg-body rounded">
                <summary class="faq-question">Do we know Python</summary>
                <span class="faq-ans">
                    Yes Yes Yes Yes Yes Yes Yes Yes Yes YesYes
                </span>
            </details>
            <details class="faq shadow-lg p-1  ps-4 mb-2 bg-body rounded">
                <summary class="faq-question">Did you used Python ?</summary>
                <span class="faq-ans">
                    No No No No No No No No No No No No No No No No No No No No No
                </span>
            </details>
            <details class="faq shadow-lg p-1  ps-4 mb-2 bg-body rounded">
                <summary class="faq-question">Do we have Blood</summary>
                <span class="faq-ans">
                    Yes Yes Yes Yes Yes Yes Yes Yes Yes YesYes
                </span>
            </details>
            <details class="faq shadow-lg p-1  ps-4 mb-2 bg-body rounded">
                <summary class="faq-question">Do we need Blood</summary>
                <span class="faq-ans">
                    Yes Yes Yes Yes Yes Yes Yes Yes Yes YesYes
                </span>
            </details>
            <details class="faq shadow-lg p-1  ps-4 mb-2 bg-body rounded">
                <summary class="faq-question">Do we share Blood</summary>
                <span class="faq-ans">
                    Yes Yes Yes Yes Yes Yes Yes Yes Yes YesYes
                </span>
            </details>
        </div>

    </div>
    <!-- FOOTER -->
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

    <!--  -->
</body>

</html>
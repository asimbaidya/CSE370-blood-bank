<?php
session_start();
require_once('./db/config.php');
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonmous">
    <!-- Javascript for bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- custom css -->
    <link rel="stylesheet" href="/static/styles/style.css">
    <link href="/asset/favicon.png" rel="icon" type="image/png" />
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


    <!------------------------------adding new post for adding post-------------  -->
    <div class="container mt-2">
        <?php
        if (isset($_SESSION['post_msg']) && !empty($_SESSION['post_msg'])) {
            $msg = $_SESSION['post_msg'];
            echo <<<ALERT
                <div class="alert alert-success" role="alert">
                $msg
                </div>
            ALERT;
            unset($_SESSION['post_msg']);
        }
        if (isset($_SESSION['solve_err']) && !empty($_SESSION['solve_err'])) {
            $msg = $_SESSION['solve_err'];
            echo <<<ALERT
                <div class="alert alert-warning" role="alert">
                $msg
                </div>
            ALERT;
            unset($_SESSION['solve_err']);
        }
        ?>
        <form action="/controller/handle-post.php?useremail=<?php echo $_SESSION['useremail'] ?>" method="POST" class="mx-1 mx-md-4">
            <div class="form-outline flex-fill mt-2 mb-1">
                <label for="blood_group">Required Blood Group</label>
                <select class="form-select" name='blood-group' aria-label="Default select example" required>
                    <option value="A+">A positive </option>
                    <option value="A-">A negative </option>
                    <option value="B+">B positive</option>
                    <option value="B-">B negative</option>
                    <option value="O+">O positive</option>
                    <option value="O-">O negative</option>
                    <option value="AB+">AB positive </option>
                    <option value="AB-">AB negative</option>
                </select>
            </div>
            <div class="form-outline flex-fill mt-1 mb-1">
                <label for="">Search Details</label>
                <textarea class="form-control" name="post-content" rows="3" placeholder="Write Your Post here ... "></textarea>
            </div>
            <div class="d-grid gap-2 flex-fill mt-4 mb-4">
                <?php
                if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin']) {
                    echo '<button type="submit" name="submit" class="btn btn-primary">Post</button>';
                } else {
                    echo '<button type="button" id="need-login" class="btn btn-outline-secondary">Post</button>';
                }
                ?>
            </div>
        </form>

        <!------------------------------Display from db--------------------  -->
        <?php
        $sql = "SELECT * FROM search where search_status='0' ORDER BY id DESC;";
        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $sid = $row['id'];
                    $content = nl2br($row['content']);
                    $blood_group = bin2hex($row['blood_group']);
                    $search_status = $row['search_status'];
                    $request_time = $row['request_time'];
                    $resolve_time = $row['resolve_time'];
                    $request_by = $row['request_by'];
                    $resolve_by = $row['resolve_by'];
                    //  formatted values
                    $date = strtotime($request_time);
                    $f_req_time = date('H:i A, l d , F, Y', $date);
                    $bg = $row['blood_group'];
                    // get full name of user who poasted
                    $sql = "SELECT first_name, last_name FROM user WHERE id = '$request_by';";
                    $res = mysqli_query($conn, $sql);
                    $name = mysqli_fetch_array($res);
                    $fn = $name['first_name'];
                    $ln = $name['last_name'];
                    $request_by_name = $fn . " " . $ln;

                    // logged user info
                    $useremail = $_SESSION['useremail'];
                    // handling issues
                    $solve_button = '';
                    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin']) {
                        $solve_button =  <<<bnt
                        <button type="submit" class="btn btn-primary" onclick="window.location.href='/controller/handle-resolve.php?search-id=$sid&sblood-group=$blood_group&request-id=$request_by&resolver-id=$useremail';">
                            Contact for Donate
                        </button>
                        bnt;
                    } else {
                        $solve_button =  <<<bnt
                        <button type="button" class="btn btn-outline-secondary" id="need-login-resolve" onclick="window.location.href='/login.php';">
                            Login & Contact for Donate
                        </button>
                        bnt;
                    }

                    // <div class="shadow-lg p-3 mb-5 bg-body rounded">Larger shadow</div>
                    echo <<<EOF
                    <div class="card m-1 shadow-lg p-3 mb-5 bg-body rounded">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="/asset/banner-search.jpg" class="rounded img-fluid p-3" alt="DeadPool" style="max-height: 300px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                         <p class="h2"> Emmergency <span class="badge bg-danger"> $bg </span> required! by <span class="text-primary">$request_by_name</span></p>
                                        <p class="lead mt-2 mb-4"> $content </p>
                                        <p class="card-text"><small class="text-muted">Requested at  $f_req_time </small></p>
                                        $solve_button
                                    </div>
                                </div>
                            </div>
                        </div>
EOF;
                }
            }
        }
        //  end of sql
        ?>
        <!-- END OF PHP -->
    </div>

    <script>
        "use strict";
        const element = document.getElementById('need-login');

        if (element) {
            element.addEventListener('click', () => {
                alert('1.You must login before posting a search request\n2.use your user account');
            })

        } else {
            console.log("No element selected by ID: need-login");
        }

        const element_resolve = document.querySelectorAll('#need-login-resolve');
        if (element_resolve) {
            element_resolve.forEach(element => {
                element.addEventListener('click', () => {
                    alert('1.Please just sign in to resolve blood search requests!\n2.use your user account');
                })

            });
        } else {
            console.log("No element selected by #need-login-resolve");
        }
    </script>


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
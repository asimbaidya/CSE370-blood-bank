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
    <link rel="stylesheet" href="/project/static/styles/style.css">
    <link href="/project/asset/favicon.png" rel="icon" type="image/png" />
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
            <a class="navbar-brand fs-1" href="/project">BloodBank</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active fs-2" aria-current="page" href="/project/donate.php">Donate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fs-2" href="/project/search.php">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fs-2" href="/project/about.php">About</a>
                    </li>
                </ul>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                    // php code
                    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin']) {
                        echo '<li class="nav-item"><a class="nav-link active fs-2" href="/project/user.php">Profile</a></li>';
                        echo '<li class="nav-item"><a class="nav-link active fs-2" href="/project/logout.php">Logout</a></li>';
                    } elseif (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin']) {
                        echo '<li class="nav-item"><a class="nav-link active fs-2" href="/project/admin.php">Admin </a></li>';
                        echo '<li class="nav-item"><a class="nav-link active fs-2" href="/project/logout.php">Logout</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link active fs-2" href="/project/login.php">Login</a></li>';
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
        ?>
        <form action="/project/controller/handle-post.php?useremail=<?php echo $_SESSION['useremail'] ?>" method="POST" class="mx-1 mx-md-4">
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
        $sql = "SELECT * FROM search ORDER BY id DESC;";
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
                    $resolved_by = $row['resolved_by'];
                    //  formatted values
                    $date = strtotime($request_time);
                    $f_req_time = date('H:i A, l d , F, Y', $date);
                    $bg = $row['blood_group'];

                    // logged user info
                    $useremail = $_SESSION['useremail'];
                    // handling issues
                    $solve_button = '';
                    if (isset($_SESSION['user_loggedin']) && $_SESSION['user_loggedin']) {
                        $solve_button =  <<<bnt
                        <button type="submit" class="btn btn-primary" onclick="window.location.href='/project/controller/handle-resolve.php?search-id=$sid&sblood-group=$blood_group&request-id=$request_by&resolver-id=$useremail';">
                            Contact for Donate
                        </button>
                        bnt;
                    } else {
                        $solve_button =  <<<bnt
                        <button type="button" class="btn btn-outline-secondary" id="need-login-resolve" onclick="window.location.href='/project/login.php';">
                            Login & Contact for Donate
                        </button>
                        bnt;
                    }

                    // <div class="shadow-lg p-3 mb-5 bg-body rounded">Larger shadow</div>
                    echo <<<EOF
                    <div class="card m-1 shadow-lg p-3 mb-5 bg-body rounded">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="/project/asset/banner-search.jpg" class="rounded img-fluid p-3" alt="DeadPool" style="max-height: 300px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <p class="h2"> Emmergency <span class="badge bg-danger"> $bg </span> required! by $request_by</p>
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
        console.log(element)
        element.addEventListener('click', () => {
            alert('You must login before posting a search request');
        })

        const element_resolve = document.querySelectorAll('#need-login-resolve');
        element_resolve.forEach(element => {
            element.addEventListener('click', () => {
                alert('Please just sign in to resolve blood search requests!');
            })

        });
        console.log(element)
    </script>


</body>

</html>
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
    <link rel="stylesheet" href="/project/static/styles/style.css" <link href="/project/asset/favicon.png" rel="icon" type="image/png" />
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


    <!------------------------------Button for adding post-------------  -->
    <div class="container mt-2">
        <div class="mx-auto">
            <button type="button" class="btn btn-primary">Make A Request for Blood</button>
        </div>


        <!------------------------------Display from db--------------------  -->
        <?php
        $sql = "SELECT * FROM search;";
        if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                echo "<hr>\n<h1>Searches</h1>";
                while ($row = mysqli_fetch_array($result)) {
                    $sid = $row['id'];
                    $content = $row['content'];
                    $blood_group = $row['blood_group'];
                    $search_status = $row['search_status'];
                    $request_time = $row['request_time'];
                    $resolve_time = $row['resolve_time'];
                    $request_by = $row['request_by'];
                    $resolved_by = $row['resolved_by'];
                    echo '<div class="card m-1">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="/project/asset/banner-login.jpg" class="rounded img-fluid p-3" alt="DeadPool" style="max-height: 300px;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h3 class="card-title">
                                        Emmergency
                                        <span class="badge bg-danger">' . $blood_group . '</span>
                                         required! by ' . $request_by . '
                                        </h3>
                                        <p class="card-text">
                                        ' . $content . '
                                        </p>
                                        <p class="card-text"><small class="text-muted">Requested at ' . $request_time . '</small></p>
                                        <button type="button" class="btn btn-primary">Give Blood Resolve</button>
                                    </div>
                                </div>
                            </div>
                        </div>';
                }
            }
        }

        ?>
        <div class="card m-1">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="/project/asset/banner-login.jpg" class="img-fluid rounded-start" alt="DeadPool" style="max-height: 300px;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title">Need A+ blood for DeadPool</h3>
                        <p class="card-text">
                            A relative of a geo faculty required A+ve Blood<br>
                            Location:Kacukhet Dhaka Cantonment<br>
                            Contact Number:01739935333<br>
                            His Condition is little bit critical if you can share this with<br>
                            students it will be help for her<br>
                        </p>
                        <p class="card-text"><small class="text-muted">Requested 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
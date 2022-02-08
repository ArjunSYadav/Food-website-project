<?php
include "databasefile.php";
require "admin/config.php";
session_start();

$page_header = basename($_SERVER['PHP_SELF']);

switch ($page_header) {
    case 'single-product.php':
        if (isset($_GET['prid'])) {
            $sql_title = "SELECT * FROM product WHERE pr_id={$_GET['prid']}";
            $result_title = mysqli_query($conn, $sql_title) or die("Title Querry faield");
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = $row_title['pr_name'] . " Pixie";
        } else {
            $page_title = "no post found";
        }
        break;
    case 'category.php':
        //category Page Title
        if (isset($_GET['catid'])) {
            if ($_GET['catid'] == '*') {
                $page_title = "Categories";
            } else {
                $sql_title = "SELECT * FROM category WHERE catid ={$_GET['catid']}";
                $result_title = mysqli_query($conn, $sql_title) or die("Title Querry faield");
                $row_title = mysqli_fetch_assoc($result_title);
                $page_title = $row_title['cat_name'] . "Pixie";
            }
        } else {
            $page_title = "no post found";
        }
        break;
    case 'user.php':
        //Author Page Title
        if (isset($_GET['user_id'])) {
            $sql_title = "SELECT * FROM user WHERE user_id ={$_GET['user_id']}";
            $result_title = mysqli_query($conn, $sql_title) or die("Title Querry faield");
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title = $row_title['user_name'];
        } else {
            $page_title = "no post found";
        }
        break;
    case 'search.php':
        //Search Page Title
        if (isset($_GET['search'])) {
            $page_title = $_GET['search'];
        } else {
            $page_title = "no post found";
        }
        break;

    default:
        $page_title = "Pixie";
        break;
}

?>


<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <title> <?php echo $page_title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <!-- Bootstrap core CSS -->
    <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://kit.fontawesome.com/2468adef90.js" crossorigin="anonymous"></script>

    <!-- Additional CSS Files -->

    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/tooplate-main.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/flex-slider.css">
    <style>
        #myBtn {

            margin-bottom: 5px;

            padding-bottom: 3px;
            outline-color: pink, 2px;
        }

        #myBtn:hover {
            background-color: #5555;
            /* Add a dark-grey background on hover */
        }

        .cart.zero::before {
            opacity: 1;
        }

        #cart_count {
            text-align: center;
            /* padding: 00.9rem 0.1rem 0.9rem; */
            /* border-radius: 3rem; */
        }
    </style>

</head>



<!-- Pre Header -->
<div id="pre-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span>what's your eating mood today?</span>
            </div>
        </div>
    </div>
</div>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top" style="margin-bottom: 60px;">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="assets/images/header-logo.png" alt="" ></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto ">

                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="products.php">Products</a>
                    <span class="sr-only">(current)</span>
                </li>
                <li class="nav-item dropdown">
                    <p class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Category
                    </p>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="category.php?catid=<?php echo '*'; ?>">All Categories</a>
                        <?php
                        //  include "databasefile.php";
                        $obj = new homeclass();
                        $obj->select('category', "*", null, null, null, null, null, null);
                        $result = $obj->getResult();
                        foreach ($result as $row) {
                        ?>

                            <a class="dropdown-item" href="category.php?catid=<?php echo $row['catid']; ?>"><?php echo $row['cat_name']; ?></a>
                        <?php
                        }

                        ?>

                    </div>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="about.php">About</a>
                    <span class="sr-only">(current)</span>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="contact.php">Contact</a>
                    <span class="sr-only">(current)</span>
                </li>
                <?php
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                    $loggedin = true;
                } else {
                    $loggedin = false;
                }
                if ($loggedin == true) {
                ?>
                    <li class="nav-item ">
                        <a class="nav-link" href="user.php?userid=<?php echo $_SESSION['user_id'] ?>"><?php echo $_SESSION['username'] ?></a>
                        <span class="sr-only">(current)</span>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="login.php">Login</a> -->
                        <a role="button" class="nav-link btn btn-outline-info " id="myBtn" href="logout.php">Logout</a>
                        <span class="sr-only">(current)</span>
                    </li><?php
                        } else {
                            ?>

                    <li class="nav-item">
                        <!-- <a class="nav-link" href="login.php">Login</a> -->
                        <a role="button" class="nav-link btn btn-outline-info " id="myBtn" href="login.php">Login</a>
                        <span class="sr-only">(current)</span>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="signup.php">Sign up</a> -->
                        <a role="button" class="nav-link btn btn-outline-info" id="myBtn" href="signup.php">Signup</a>
                        <span class="sr-only">(current)</span>
                    </li>
                <?php
                        }
                ?>
                <!-- <i class="bi bi-cart"></i> -->
                <?php
                if (isset($_SESSION['cart'])) {
                    $count = count($_SESSION['cart']);
                } else {
                    $count = 0;
                }

                ?>
                <li class="nav-item ml-0">
                    <a class="nav-link " href="usercart.php">
                        <h2 class=" cart "><i class="fas fa-cart-plus"><?php echo $count; ?></i></h2>
                    </a>

                    <span class="sr-only">(current)</span>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- <script src="vendor/jquery/jquery.js"></script> -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    jQuery(function($) {
        var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
        $(".navbar-nav > li > a").each(function() {
            if ($(this).attr("href") == pgurl || $(this).attr("href") == '') {
                $(this).parent("li").addClass("active");
            }
        });
    });
</script>
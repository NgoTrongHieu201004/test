
<?php
session_start();
if($_SESSION['role'] != 1){
    header('location:../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Mobile Admin</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="./images/logo.png" type="image/icon type">
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/uniform.css" />
        <link rel="stylesheet" href="css/select2.css" />
        <link rel="stylesheet" href="css/matrix-style.css" />
        <link rel="stylesheet" href="css/matrix-media.css" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link
            href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800'
            rel='stylesheet' type='text/css'>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style type="text/css">
        ul.pagination {
            list-style: none;
            float: right;
        }

        ul.pagination li.active {
            font-weight: bold
        }

        ul.pagination li {
            display: flex;
            padding: 10px
        }
    </style>
    </head>

    <body>
        <?php 
        require "config.php";
        require "models/db.php";
        require "models/product.php";
        require "models/manufacture.php";
        require "models/protype.php";
        require "models/user.php";
        require "models/thanhtoan.php";
        $products = new Product; 
        $manufacture = new Manufacture; 
        $protype = new Protype ; 
        $user = new User();
        $thanhtoan = new ThanhToan();
        ?>
        <!--Header-part-->
        <div id="header" class="">
            <h1><a href="#"><img src="./images/logo.png" alt=""></a></h1>
        </div>
        <!--close-Header-part-->
        <!--top-Header-menu-->
        <div id="user-nav" class="navbar navbar-inverse " >
            <ul class="nav">
                <li class="dropdown" id="profile-messages"><a title="" href="#"
                        data-toggle="dropdown"
                        data-target="#profile-messages" class="dropdown-toggle"><i
                            class="icon icon-user"></i> <span
                            class="text">Welcome Super Admin</span><b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.html"><i class="icon-key"></i> Log
                                Out</a></li>
                    </ul>
                </li>
                <li class="dropdown" id="menu-messages"><a href="#"
                        data-toggle="dropdown" data-target="#menu-messages"
                        class="dropdown-toggle"><i class="icon icon-envelope"></i>
                        <span class="text">Messages</span> <span
                            class="label label-important">5</span> <b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a class="sAdd" title="" href="#"><i
                                    class="icon-plus"></i> new message</a></li>
                        <li class="divider"></li>
                        <li><a class="sInbox" title="" href="#"><i
                                    class="icon-envelope"></i> inbox</a></li>
                        <li class="divider"></li>
                        <li><a class="sOutbox" title="" href="#"><i
                                    class="icon-arrow-up"></i> outbox</a></li>
                        <li class="divider"></li>
                        <li><a class="sTrash" title="" href="#"><i
                                    class="icon-trash"></i> trash</a></li>
                    </ul>
                </li>
                <li class=""><a title="" href="#"><i class="icon icon-cog"></i>
                        <span class="text">Settings</span></a></li>
                <li class=""><a title="" href="../index.php"><i class="icon
                            icon-share-alt"></i> <span class="text">Logout</span></a>
                </li>
            </ul>
        </div>
        <!--start-top-serch-->
        <div id="search">
            <form action="result.php" method="get">
                <input type="text" name="key"  style = "height: 34px;  width: 250px;" placeholder="Search here..." />
                <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
            </form>  
        </div>
        <!--close-top-serch-->
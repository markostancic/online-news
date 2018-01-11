<?php
session_start();
	require_once __DIR__ . '../php/baza/DB.php';
    $db = new \Baza\DB();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Oline vesti</title>

    <meta charset="utf-8">

    <meta name="description" content="početna">

    <meta name="keywords" content="web, design, html, css, html5, css3, javascript, jquery, bootstrap, development">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:500italic,600italic,600,700,700italic,300italic,300,400,400italic,800,900' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,600italic,700,900' rel='stylesheet' type='text/css'>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" type="text/css" href="css/animate.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- BX slider CSS -->
    <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css">

    <!-- responsive css -->
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top example6">


        <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" id="menu11">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="index.php" class="nav-item">Pocetna</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    
                            if(!isset($_SESSION['id']))
                            {
                                echo "<div class='dropdown' id='lista'>
                                        <button class='btn btn-default dropdown-toggle' type='button' style='color:#fff;' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>Moj nalog
                                            <span class='caret' id='strelica'></span>
                                        </button>
                                        <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                           <li><a href='php/registracija.php'>Registruj se</a></li>
                                           <li><a href='php/login.php'>Uloguj se</a></li>
                                        </ul>
                                    </div>";
                            }
                            else
                            {
                                echo "<div class='dropdown' id='lista'>
                                        <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' style='color:#fff;' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>Moj nalog
                                            <span class='caret' id='strelica'></span>
                                        </button>";
                                
                                    echo "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                           <li><a href='php/edit.php'>Informacije o nalogu</a></li>
                                           <li><a href='php/logout.php?logout=1'>Izloguj se</a></li>
                                        </ul>
                                    </div>";
                                
                            }
                        ?>
                </ul>


            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div class="container">

        <?php
            require_once __DIR__ . '../php/baza/DB.php';
            $db = new \Baza\DB();
            //$id = $_GET['id'];
            $vest = $db->fetchAll("SELECT * FROM vest;");
            if(!isset($_SESSION['id'])){
                foreach ($vest as $vesti)
                {   

                    echo "<div class='col-md-3' style='margin-top:100px;'><a class='vest' href ='/vesti/php/login.php'>";
                    echo " <div class='row'>Naslov: {$vesti['naslov']} | Autor: {$vesti['autor']}</div>";
                    echo " <div class='row'><img src='images/".$vesti['slika']."' style='width:250px; height:250px;' ></div>";
                    echo " <div class='row'>{$vesti['text']}</div>";
                    echo "</a></div>";

                }
            } else {
                foreach ($vest as $vesti)
                {   
                    
                    echo "<div class='col-md-3' style='margin-top:100px;'><a class='vest' href ='/vesti/php/vesti.php?id={$vesti['id']}'>";
                    echo " <div class='row'>Naslov: {$vesti['naslov']} | Autor: {$vesti['autor']}</div>";
                    echo " <div class='row'><img src='images/".$vesti['slika']."' style='width:250px; height:250px;' ></div>";
                    echo " <div class='row'>{$vesti['text']}</div>";
                    echo "</a></div>";

                }
            } 
            ?>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Bx Slider JS -->
    <script src="js/jquery.bxslider.min.js"></script>

    <!-- Add JS counter lib -->
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>

    <!-- Add wow js lib -->
    <script src="js/wow.min.js"></script>

    <!-- Custom Js -->

</body>

</html>
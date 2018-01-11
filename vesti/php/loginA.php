<?php
require_once __DIR__ . '/baza/DB.php';
$db = new \Baza\DB();

function Login($db)
{

    if(isset($_POST['login'])){
        $korisnicko_ime = $_POST['korisnicko_ime'];
        $sifra = $_POST['sifra'];
        
        $korisnicko_ime = $db->prepareString($korisnicko_ime);
        $sifra = md5($db->prepareString($sifra));
        
        $korisnik = $db->fetch("SELECT * FROM admin WHERE korisnicko_ime = '{$korisnicko_ime}' AND sifra= '{$sifra}'");
        if (empty($korisnik)) {
            echo "nije dobro";
            
            
        } else {
                $_SESSION['admin'] = 1;// user ulogovan
                $_SESSION['tip'] =$korisnik['tip'];//koji je tip: da li je admin ili upravnik
        }
            
    }
        
    
}





function loginScreen()
{
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Prijavljivanje</title>
        <?php
        require_once __DIR__ . '/header.php';  
    ?>
    </head>

    <body>
        <div class="col-md-6 col-md-offset-3" id="login">
            <form action="" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="korisnicko_ime" class="col-sm-3 control-label">Korisnicko ime</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime" placeholder="korisnicko_ime" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sifra" class="col-sm-3 control-label">Lozinka</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="sifra" name="sifra" placeholder="Lozinka" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <span id="loginError"></span>
                        <button type="submit" id="loginButton" name="login" class="btn btn-default">Sign in</button>
                    </div>
                </div>
            </form>
        </div>
        <?php
        require_once __DIR__ . '/footer.php';  
    ?>
    </body>

    </html>
    <?php
}
function mainMenu()
{
    if ($_SESSION['tip'] == "admin") {
?>
        <!DOCTYPE html>
        <html>

        <head>
            <title>Admin panel</title>
            <?php
        require_once __DIR__ . '/header.php';  
    ?>
        </head>

        <body>
            <div class="row">
                <div id="admin-menu">
                    <nav class="container-fluid" id="menu1">
                        <h2>Admin panel</h2>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div id="menu2">
                            <ul class="nav navbar-nav" id="menu3">
                                <ul class="nav nav-navbar">
                                    <li><a href="../php/pregled-upravnika.php">Pregled upravnika</a></li>
                                    <li><a href="../php/pregled-korisnika.php">Pregled korisnika</a></li>
                                    <li><a href="../php/pregled-vesti.php">Pregled vesti</a></li>
                                    <li><a href="index.php?logout=1">Logout</a></li>
                                </ul>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->

                    </nav>
                </div>
            </div>
            <?php
    } else {
        ?>
                <!DOCTYPE html>
                <html>

                <head>
                    <title>Admin panel</title>
                    <?php
        require_once __DIR__ . '/header.php';  
    ?>
                </head>

                <body>
                    <div class="row">
                        <div id="admin-menu">
                            <nav class="container-fluid" id="menu1">
                                <h2>Upravnik</h2>
                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div id="menu2">
                                    <ul class="nav navbar-nav" id="menu3">
                                        <ul class="nav nav-navbar">
                                            <li><a href="../php/pregled-vesti.php">Pregled vesti</a></li>
                                            <li><a href="index.php?logout=1">Logout</a></li>
                                        </ul>
                                    </ul>
                                </div>
                                <!-- /.navbar-collapse -->

                            </nav>
                        </div>
                    </div>
                    <?php
    }
        require_once __DIR__ . '/footer.php';  
    ?>

                </body>

                </html>
                <?php
  }
function checkLogout($db)
{
  if (isset($_GET['logout'])) {
    if ($_GET['logout'] == 1) {
        
     session_destroy(); 
    header('location: index.php');
    }
  }
}
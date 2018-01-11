<?php
require_once __DIR__ . '/baza/DB.php';
$db = new \Baza\DB();
session_start();

        if(isset($_POST['login'])){
        $korisnicko_ime = $_POST['korisnicko_ime'];
        $sifra = $_POST['sifra'];
        
        $korisnicko_ime = $db->prepareString($korisnicko_ime);
        $sifra = md5($db->prepareString($sifra));
        
        $korisnik = $db->fetch("SELECT * FROM korisnik WHERE korisnicko_ime = '{$korisnicko_ime}' AND sifra= '{$sifra}'");
        //var_dump($korisnik);
        if (empty($korisnik)) {
            echo "nije dobro";
            
            
        } else {
            $_SESSION['id'] = $korisnik['id'];
            //$_SESSION['id'] = 1;// user ulogovan
            
            //$_SESSION['korisnicko_ime'] = $korisnicko_ime
            header('location:../index.php');
        }
            
    }
?>
    <html>

    <head>
        <title>Login</title>

        <?php
        require_once __DIR__ . '/header.php';  
    ?>
    </head>

    <body>
        <div class="col-md-6 col-md-offset-3" id="login1">
            <form action="" method="post" class="form-horizontal">
                <div class="md-form">
                    <div class="col-sm-9">
                        <div class="col-sm-1">
                            <i class="fa fa-user fa-2x"></i>
                        </div>
                        <div class="col-sm-11">
                            <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime" placeholder="Korisničko ime" required>
                        </div>
                    </div>
                </div>
                <div class="md-form">
                    <div class="col-sm-9">
                        <div class="col-sm-1">
                            <i class="fa fa-lock fa-2x"></i>
                        </div>
                        <div class="col-sm-11">
                            <input type="password" class="form-control" id="sifra" name="sifra" placeholder="Lozinka" required>
                        </div>
                    </div>
                </div>
                <div class="md-form">
                    <div class="col-sm-offset-3 col-sm-9">
                        <span id="loginError"></span>
                        <button type="submit" id="loginButton" name="login" class="btn btn-success">Sign in</button>
                        <a href="../index.php" id="close" name="close" class="btn btn-warning">Odustani</a>
                    </div>
                </div>
            </form>

        </div>

        <?php
        require_once __DIR__ . '/footer.php';  
    ?>

    </body>

    </html>
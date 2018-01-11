<?php

session_start();




?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Izmeni upravnika</title>
        <?php
        require_once __DIR__ . '/header.php';  
    ?>
    </head>

    <body>

        <?php
	require_once __DIR__ . '/baza/DB.php';
    $db = new \Baza\DB();
    
    $id = $_GET['id'];

    $rez = $db->fetch("SELECT * FROM admin WHERE id = {$id} AND tip='upravnik';");

?>
            <div class="col-md-6 col-md-offset-3 form-horizontal">
                <h1>Izmena upravnika</h1>
                <form action="db-izmeni-upravnika.php" method="post">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>"> Ime: <input type="text" name="ime" class="form-control" value="<?php echo $rez['ime']; ?>"><br/> Prezime: <input type="text" name="prezime" class="form-control" value="<?php echo $rez['prezime']; ?>"><br/> Email: <input type="text" name="email" class="form-control" value="<?php echo $rez['email']; ?>"><br/> Korisničko ime: <input type="text" class="form-control" name="korisnicko_ime" value="<?php echo $rez['korisnicko_ime']; ?>"><br/> Lozinka: <input type="password" class="form-control" name="sifra"><br/>
                    <div class="col-md-4 col-md-offset-4">
                        <input type="submit" class="btn btn-md btn-success" value="Izmeni">
                        <a href="pregled-upravnika.php" class="btn btn-md btn-warning" id="dugme2">Odustani</a>
                    </div>
                </form>
            </div>
            <?php

?>
    </body>

    </html>
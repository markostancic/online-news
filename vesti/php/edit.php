<?php
    session_start();
?>
    <!DOCTYPE html>
    <html>

    <head>
       <?php
        require_once __DIR__ . '/header.php';  
        ?>
        <title>Izmeni restoran</title>

    </head>

    <body>

        <?php
	require_once __DIR__ . '/baza/DB.php';
    $db = new \Baza\DB();
    
    //$id = $_GET['id'];
    $id = $_SESSION['id'];
    $rezervacije = $db->fetch("SELECT * FROM korisnik WHERE id = {$id};");

?>
           <div class="col-md-6 col-md-offset-3">
            <div class="form forma">
                <h1>Izmena naloga</h1>
                <form action="db-edit.php" method="post">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>"><br/> 
                    Ime: <input type="text" name="ime" class="form-control" value="<?php echo $rezervacije['ime']; ?>"><br/> 
                    Prezime: <input type="text" name="prezime" class="form-control" value="<?php echo $rezervacije['prezime']; ?>"><br/>
                    Telefon: <input type="number" name="telefon" class="form-control" value="<?php echo $rezervacije['telefon']; ?>"><br/>
                    Email: <input type="email" name="email" class="form-control" value="<?php echo $rezervacije['email']; ?>"><br/> 
                    <div class="col-md-4 col-md-offset-4 ">
                    <input type="submit" class="btn btn-md btn-success" value="Izmeni">
                    <a href="../index.php" class="btn btn-md btn-warning" id="dugme2">Odustani</a>
                    </div>
                </form>
            </div>
        </div>
               <!-- Bx Slider JS -->
            <script src="../js/jquery.bxslider.min.js"></script>

            <!-- Add JS counter lib -->
            <script src="../js/jquery.waypoints.min.js"></script>
            <script src="../js/jquery.counterup.min.js"></script>

            <!-- Add wow js lib -->
            <script src="../js/wow.min.js"></script>

            <!-- Custom Js -->
            <script src="../js/input.js"></script>
    </body>

    </html>
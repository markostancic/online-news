    <?php

    require_once __DIR__ . '/baza/DB.php';
    $db = new \Baza\DB();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Izmeni informacije o korisniku</title>
        <?php
        require_once __DIR__ . '/header.php';  
    ?>
</head>

<body>

    <?php    
    $id = $_GET['id'];
    $user = $db->fetch("SELECT * FROM korisnik WHERE id = {$id};");


    
?>
        <div class="col-md-6 col-md-offset-3">
            <div class="form forma">
                <h1>Izmena podataka o korisniku</h1>
                <form action="db-izmeni-korisnika.php" method="post">
                    <input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>"> 
                    Ime: <input type="text" name="ime" class="form-control" value="<?php echo $user['ime']; ?>"><br/> 
                    Prezime: <input type="text" name="prezime" class="form-control" value="<?php echo $user['prezime']; ?>"><br/> 
                    Email: <input type="text" name="email" class="form-control" value="<?php echo $user['email']; ?>"><br/> 
                    Korisnicko ime: <input type="text" name="korisnicko_ime" class="form-control" value="<?php echo $user['korisnicko_ime']; ?>"><br/> 
                    Lozinka: <input type="password" name="sifra" class="form-control"><br/> 
                    ulica: <input type="text" name="ulica" class="form-control" value="<?php echo $user['ulica']; ?>"><br/> 
                    Broj: <input type="text" name="broj" class="form-control" value="<?php echo $user['broj']; ?>"><br/>
                    Telefon: <input type="text" name="telefon" class="form-control" value="<?php echo $user['telefon']; ?>"><br/>
                <div class="col-md-4 col-md-offset-4 ">
                    <input type="submit" class="btn btn-md btn-success" value="Izmeni">
                    <a href="../admin/index.php" class="btn btn-md btn-warning" id="dugme2">Odustani</a>
                    <p><span style="color:red;">*</span> <?php echo isset($info) ? $info : 'obavezno polje'?></p>
                </div>
                </form>
                <div class="col-md-4 col-md-offset-4" id="greske">
        <?php
        if (!empty($greske)) {
            foreach ($greske as $greska) {
                echo $greska . '<br>';
            }
        }
        ?>
    </div>
            </div>
        </div>
        <?php
        require_once __DIR__ . '/footer.php';  
    ?>
</body>

</html>
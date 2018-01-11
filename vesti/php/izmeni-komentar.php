
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
	require_once __DIR__ . '/baza/DB.php';
    $db = new \Baza\DB();
    
    $id = $_GET['id'];
    $kom = $db->fetch("SELECT * FROM komentari WHERE id = {$id};");
    

    
?>
        <div class="col-md-6 col-md-offset-3">
            <div class="form forma">
                <h1>Izmena podataka o korisniku</h1>
                <form action="db-izmeni-komentar.php" method="post">
                    <input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>"> 
                    Ime: <input type="text" name="korisnik" class="form-control" value="<?php echo $kom['korisnik']; ?>"><br/> 
                    Poruka: <input type="textarea" name="text" class="form-control" value="<?php echo $kom['text']; ?>"><br/> 
                <div class="col-md-4 col-md-offset-4 ">
                    <input type="submit" id="submit" class="btn btn-md btn-success" value="Izmeni">
                    <a href="../index.php" class="btn btn-md btn-warning" id="dugme2">Odustani</a>
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
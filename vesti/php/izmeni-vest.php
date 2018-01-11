    <?php
    require_once 'loginA.php';
    require_once __DIR__ . '/baza/DB.php';
    $db = new \Baza\DB();

        ?>
    <!DOCTYPE html>
<html>

<head>
    <title>Izmeni vest</title>
        <?php
        require_once __DIR__ . '/header.php';  
    ?>
</head>

<body>

    <?php
	require_once __DIR__ . '/baza/DB.php';
    $db = new \Baza\DB();
    
    $id = $_GET['id'];

    $vest = $db->fetch("SELECT * FROM vest WHERE id = {$id};");
?>
        <div class="col-md-6 col-md-offset-3">
            <div class="form forma">
                <h1>Izmena podataka o korisniku</h1>
                <form action="db-izmeni-vest.php" method="post">
                    <input type="hidden" name="id" class="form-control" value="<?php echo $id; ?>"> 
                    Naslov: <input type="text" name="naslov" class="form-control" value="<?php echo $vest['naslov']; ?>"><br/> 
                    Autor: <input type="text" name="autor" class="form-control" value="<?php echo $vest['autor']; ?>"><br/> 
                    Datum: <input type="date" name="datum" class="form-control" value="<?php echo $vest['datum']; ?>"><br/> 
                    Text: <input type="text" name="text" class="form-control" value="<?php echo $vest['text']; ?>"><br/>
                    Slika: <input class="input-group" type="file" name="slika" accept="images/*"  value="<?php echo $vest['slika']; ?>"/><br/>
                <div class="col-md-4 col-md-offset-4 ">
                    <input type="submit" class="btn btn-md btn-success" value="Izmeni">
                    <a href="../index.php" class="btn btn-md btn-warning" id="dugme2">Odustani</a>
                </div>
                </form>
            </div>
        </div>
        <?php
        require_once __DIR__ . '/footer.php';  
    ?>
</body>

</html>
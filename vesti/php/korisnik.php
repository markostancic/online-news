<?php
session_start();
require_once 'loginA.php';
require_once __DIR__ . '/baza/DB.php';
$db = new \Baza\DB();

if (!isset($_SESSION['admin'])) {
    //echo $_SESSION['korisnik_id'];
    $_SESSION['admin'] = 0;

}

checkLogout($db);
Login($db);


if ($_SESSION['admin'] == 0) {
  //poziv f-je sa formom za logovanje
    loginScreen();

} else {
  //poziv f-je meni u slucaju da je korisnik ulogovan


$greske = array();

if (isset($_POST['submit'])) {
    $ime = isset($_POST['ime']) ? $db->prepareString($_POST['ime']) : null;
    if (empty($ime)) {
        $greske[] = 'Polje za ime je prazano';
    }
    $prezime = isset($_POST['prezime']) ? $db->prepareString($_POST['prezime']) : null;
    if (empty($prezime)) {
        $greske[] = 'Polje za prezime je prazno';
    }
        $email = isset($_POST['email']) ? $db->prepareString($_POST['email']) : null;
    if (empty($email)) {
        $greske[] = 'Polje za email je prazno';
    }
    $ulica = isset($_POST['ulica']) ? $db->prepareString($_POST['ulica']) : null;
    if (empty($ulica)) {
        $greske[] = 'Polje za ulicu je prazno';
    }
    $broj = isset($_POST['broj']) ? $db->prepareString($_POST['broj']) : null;
    if (empty($broj)) {
        $greske[] = 'Polje za broj je prazno';
    }
    $telefon = isset($_POST['telefon']) ? $db->prepareString($_POST['telefon']) : null;
    if (empty($telefon)) {
        $greske[] = 'Polje za telefon je prazno';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Email nije ispravan";
    }
    $korisnicko_ime = isset($_POST['korisnicko_ime']) ? $db->prepareString($_POST['korisnicko_ime']) : null;
    if (empty($korisnicko_ime)) {
        $greske[] = 'Polje za korisničko ime je prazno';
    }
    $sifra = isset($_POST['sifra']) ? $db->prepareString($_POST['sifra']) : null;
    if (empty($sifra)) {
        $greske[] = 'Polje za lozinku je prazno';
    }
    $sifra1 = md5($db->prepareString($sifra));
    $sifra2 = isset($_POST['sifra2']) ? $db->prepareString($_POST['sifra2']) : null;
    if (empty($sifra2)) {
        $greske[] = 'Polje za ponovljenu lozinku je prazno';
    }
    $sifra3 = md5($db->prepareString($sifra2));
    if (!ctype_alpha($ime)) {
        $greske[] = 'Ime nije dobro';
    }
    if (!ctype_alpha($prezime)) {
        $greske[] = 'Prezime nije dobro';
    }
    if (!ctype_alpha($ulica)) {
        $greske[] = 'Ulica nije dobra';
    }
    if (!ctype_digit($broj)) {
        $greske[] = 'Broj nije dobar';
    }
    if (!ctype_digit($telefon)) {
        $greske[] = 'Telefon nije dobar';
    }
    if($_POST['sifra'] != $_POST['sifra2']){
        $greske[] = 'Lozinke se ne poklapaju.';
    }
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $korisnicko_ime)) {
        $greske[] = 'Korisnicko ime sadrzi nedozvoljene karaktere!.';
    }
    if(strlen($sifra)<8){
        $greske[] = 'Sifra mora da sadrzi najmanje osam karaktera';
    }
    if(strlen($sifra2)<8){
        $greske[] = 'Sifra mora da sadrzi najmanje osam karaktera';
    }
    if (!preg_match('/[A-Z]+[a-z]+[0-9]+/', $sifra)) {
        $greske[] = 'Sifra mora da sadrzi velika i mala slova i brojeve';
    }
    if (!preg_match('/[A-Z]+[a-z]+[0-9]+/', $sifra2)) {
        $greske[] = 'Sifra mora da sadrzi velika i mala slova i brojeve';
    }


    if (empty($greske)) {
        $sql = "INSERT INTO korisnik (ime, prezime, email, korisnicko_ime, sifra, sifra2, ulica, broj, telefon) "
            ." VALUES ('{$ime}', '{$prezime}', '{$email}', '{$korisnicko_ime}', '{$sifra1}', '{$sifra3}', '{$ulica}', '{$broj}', '{$telefon}');";
        $res = $db->exec($sql);
        if (empty($res)) {
            var_dump('nije uspeo upis u bazu');
            die;
        }
        $info = "Uspesno ste dodali korisnika!";
        $_POST = array();
        header("Location: pregled-korisnika.php");
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <title>Dodavanje korisnika</title>
    <meta charset="UTF-8">
</head>
<body>
<h1 class="col-md-4 col-md-offset-4">Dodavanje korisnika</h1>
<div class="forma form-horizontal col-md-6 col-md-offset-3">
    <form action="korisnik.php" method="post">
        <p>Ime <span style="color:red;">*</span><br>
            <span><input type="text" name="ime" class="form-control" value="<?php echo isset($_POST['ime']) ? $_POST['ime'] : ''?>" size="40"aria-required="true" aria-invalid="false"></span> </p>
        <p>Prezime <span style="color:red;">*</span><br>
            <span><input type="text" name="prezime" class="form-control" value="<?php echo isset($_POST['prezime']) ? $_POST['prezime'] : ''?>" size="40"aria-required="true" aria-invalid="false"></span> </p>
        <p>Email <span style="color:red;">*</span><br>
            <span><input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''?>" size="40" aria-required="true" aria-invalid="false" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"></span> </p>
        <p>Korisničko ime <span style="color:red;">*</span><br>
            <span><input type="text" name="korisnicko_ime" class="form-control" value="<?php echo isset($_POST['korisnicko_ime']) ? $_POST['korisnicko_ime'] : ''?>" size="40"></span> </p>
        <p>Lozinka <span style="color:red;">*</span><br>
            <span><input type="password" name="sifra" class="form-control" value="<?php echo isset($_POST['sifra']) ? $_POST['sifra'] : ''?>" size="40" aria-required="true" aria-invalid="false"></span> </p>
        <p>Ponovljena lozinka <span style="color:red;">*</span><br>
            <span><input type="password" name="sifra2" class="form-control" value="<?php echo isset($_POST['sifra2']) ? $_POST['sifra2'] : ''?>" size="40" aria-required="true" aria-invalid="false"></span> </p>
         <p>Ulica <span style="color:red;">*</span><br>
            <span><input type="text" name="ulica" class="form-control" value="<?php echo isset($_POST['ulica']) ? $_POST['ulica'] : ''?>" size="40"aria-required="true" aria-invalid="false"></span> </p>
        <p>Broj <span style="color:red;">*</span><br>
            <span><input type="text" name="broj" class="form-control" value="<?php echo isset($_POST['broj']) ? $_POST['broj'] : ''?>" size="40"aria-required="true" aria-invalid="false"></span> </p>
        <p>Telefon <span style="color:red;">*</span><br>
            <span><input type="text" name="telefon" class="form-control" value="<?php echo isset($_POST['telefon']) ? $_POST['telefon'] : ''?>" size="40"aria-required="true" aria-invalid="false"></span> </p>   
        <div class="col-md-4 col-md-offset-4">
        <tr><input type="submit" name="submit" class="btn btn-md btn-success dugme2" value="Dodajte">
        <a href="../admin/index.php" class="btn btn-md btn-warning dugme2">Nazad</a></tr>
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
<?php
}
?>
</body>
</html>
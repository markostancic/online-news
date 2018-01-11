<?php

session_start();
require_once 'loginA.php';

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



?>
<!DOCTYPE html>
<html>
<head>
    
	<title>Korisnici</title>
    <?php
        require_once __DIR__ . '/header.php';  
    ?>
</head>
<body>
<div class="restoran">
    <h1>Pregled korisnika</h1>
    <br>
    <div>
        <table class="table table-hover" border="1">
            <thead>
            <tr>
                <th>#</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Email</th>
                <th>Korisničko ime</th>
                <th>Ulica</th>
                <th>Broj</th>
                <th>Telefon</th>
                <th></th>
                <th></th>

            </tr>
            </thead>
            <tbody id="korisnik_table">
            <?php
            require_once __DIR__ . '/baza/DB.php';
            $db = new \Baza\DB();
            $i=1;
            $korisnik = $db->fetchAll("SELECT * FROM korisnik;");
            foreach ($korisnik as $rez)
            {
                echo "<tr>\n";
                echo " <td>$i</td>\n";
                echo " <td>{$rez['ime']}</td>\n";
                echo " <td>{$rez['prezime']}</td>\n";
                echo " <td>{$rez['email']}</td>\n";
                echo " <td>{$rez['korisnicko_ime']}</td>\n";
                echo " <td>{$rez['ulica']}</td>\n";
                echo " <td>{$rez['broj']}</td>\n";
                echo " <td>{$rez['telefon']}</td>\n";
                echo " <td><a href='izmeni-korisnika.php?id={$rez['id']}' id='dugme'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>\n";
                echo " <td><a href='db-ukloni-korisnika.php?id={$rez['id']}' id='dugme' onclick='if(!confirm(\"Da li ste sigurni?\"))return false;'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>\n";
              $i++;  
            }
            
            ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="../admin/index.php" class="btn btn-md btn-warning" id="dugme1">Nazad</a>
    <a href="korisnik.php" class="btn btn-md btn-info" id="dugme2">Dodaj korisnika</a>
</div>
<br>

    <?php
    }
        require_once __DIR__ . '/footer.php';  
    ?>
</body>
</html>




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
    
	<title>Upravnici</title>
    <?php
        require_once __DIR__ . '/header.php';  
    ?>
</head>
<body>
<div class="restoran">
    <h1>Pregled upravnika</h1>
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
                <th></th>
                <th></th>

            </tr>
            </thead>
            <tbody id="upravnik_table">
            <?php
            require_once __DIR__ . '/baza/DB.php';
            $db = new \Baza\DB();
            $i=1;
            $upravnik = $db->fetchAll("SELECT * FROM admin WHERE tip='upravnik';");
            foreach ($upravnik as $rez)
            {
                echo "<tr>\n";
                echo " <td>$i</td>\n";
                echo " <td>{$rez['ime']}</td>\n";
                echo " <td>{$rez['prezime']}</td>\n";
                echo " <td>{$rez['email']}</td>\n";
                echo " <td>{$rez['korisnicko_ime']}</td>\n";
                echo " <td><a href='izmeni-upravnika.php?id={$rez['id']}' id='dugme'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>\n";
                echo " <td><a href='db-ukloni-upravnika.php?id={$rez['id']}' id='dugme' onclick='if(!confirm(\"Da li ste sigurni?\"))return false;'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>\n";
              $i++;  
            }
            
            ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="../admin/index.php" class="btn btn-md btn-warning" id="dugme1">Nazad</a>
    <a href="upravnik.php" class="btn btn-md btn-info" id="dugme2">Dodaj upravnika</a>
</div>
<br>

    <?php
    }
        require_once __DIR__ . '/footer.php';  
    ?>
</body>
</html>




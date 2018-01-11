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
    
	<title>Vesti</title>
    <?php
        require_once __DIR__ . '/header.php';  
    ?>
</head>
<body>
<div class="restoran">
    <h1>Pregled vesti</h1>
    <br>
    <div>
        <table class="table table-hover" border="1">
            <thead>
            <tr>
                <th>#</th>
                <th>Naslov</th>
                <th>Autor</th>
                <th>Datum</th>
                <th>Text</th>
                <th>Slika</th>
                <th></th>
                <th></th>

            </tr>
            </thead>
            <tbody id="vest_table">
            <?php
            require_once __DIR__ . '/baza/DB.php';
            $db = new \Baza\DB();
            $i=1;
            $vesti = $db->fetchAll("SELECT * FROM vest;");
            foreach ($vesti as $rez)
            {
                echo "<tr>\n";
                echo " <td>$i</td>\n";
                echo " <td>{$rez['naslov']}</td>\n";
                echo " <td>{$rez['autor']}</td>\n";
                echo " <td>{$rez['datum']}</td>\n";
                echo " <td>{$rez['text']}</td>\n";
                echo " <td>{$rez['slika']}</td>\n";
                echo " <td><a href='izmeni-vest.php?id={$rez['id']}' id='dugme'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>\n";
                echo " <td><a href='db-ukloni-vest.php?id={$rez['id']}' id='dugme' onclick='if(!confirm(\"Da li ste sigurni?\"))return false;'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>\n";
                echo "</tr>\n";
              $i++;  
            }
            
            ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="../admin/index.php" class="btn btn-md btn-warning" id="dugme1">Nazad</a>
    <a href="vest.php" class="btn btn-md btn-info" id="dugme2">Dodaj vest</a>
</div>
<br>

    <?php
    }
        require_once __DIR__ . '/footer.php';  
    ?>
</body>
</html>




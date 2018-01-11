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

?>
<!DOCTYPE html>
<html>

<head>

    <title>Rezervaije</title>
    <?php
        require_once __DIR__ . '/header.php';  
    ?>
        <link rel="stylesheet" type="text/css" href="../css/ispit.css">
</head>

<body>
    <div class="restoran">
        <h1>Pregled rezervacija</h1>
        <br>


        <div>
            <table id="app_table" border="1">
                <thead>
                    <tr>
                        <th>Redni broj</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Telefon</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <?php
            require_once __DIR__ . '/baza/DB.php';
            $db = new \Baza\DB();
            $rezervacije = $db->fetchAll("SELECT * FROM korisnik;");
            foreach ($rezervacije as $rez)
            {
                echo "<tr>\n";
                echo " <td>{$rez['id']}</td>\n";
                echo " <td>{$rez['ime']}</td>\n";
                echo " <td>{$rez['prezime']}</td>\n";
                echo " <td>{$rez['telefon']}</td>\n";
                echo " <td>{$rez['email']}</td>\n";
                echo " <td>{$rez['napomena']}</td>\n";
                echo " <td><a href='izmeni-rezervaciju.php?id={$rez['id']}' id='dugme'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>\n";
                echo " <td><a href='db-ukloni-rezervaciju.php?id={$rez['id']}' id='dugme' onclick='if(!confirm(\"Da li ste sigurni?\"))return false;'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>\n";
                echo "</tr>\n";
                $i++;
            }
            
            ?>
            </table>
        </div>
        <br>
        <a href="../admin/index.php" id="dugme1">Nazad</a>
    </div>
    <br>
    <?php
    }
    ?>
</body>

</html>
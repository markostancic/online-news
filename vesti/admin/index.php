<?php

session_start();
require_once '../php/loginA.php';
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
    mainMenu();

}

?>
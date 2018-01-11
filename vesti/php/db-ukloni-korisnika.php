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



$id = $_GET['id'];

$upit = "DELETE FROM `korisnik` WHERE id = {$id};";
$res = $db->exec($upit);
if (empty($res)) {
    var_dump('nije uspeolo brisanje iz baze');
    die;
}

header("Location: pregled-korisnika.php");
}
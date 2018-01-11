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

 $id = $_POST['id'];

$naslov = $_POST['naslov'];
$autor = $_POST['autor'];
$datum = $_POST['datum'];
$text = $_POST['text'];

$upit = "UPDATE vest SET naslov = '{$naslov}', autor = '{$autor}', datum = '{$datum}', text = '{$text}'  WHERE id = {$id};";
$res = $db->exec($upit);
if (empty($res)) {
    echo"<script>alert('Nije uspela izmena');</script>";
    echo"<script>window.location.href = 'pregled-vesti.php';</script>";

}



header("Location: pregled-vesti.php");

}


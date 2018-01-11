<?php

session_start();
require_once 'loginA.php';
require_once __DIR__ . '/baza/DB.php';
$db = new \Baza\DB();

if (!isset($_SESSION['admin'])) {
    $_SESSION['admin'] = 0;

}

checkLogout($db);
Login($db);


if ($_SESSION['admin'] == 0) {
  //poziv f-je sa formom za logovanje
    loginScreen();

} else {

 $id = $_POST['id'];

$ime = $_POST['ime'];
$prezime = $_POST['prezime'];
$email = $_POST['email'];
$korisnicko_ime = $_POST['korisnicko_ime'];
$sifra = $_POST['sifra'];
$sifra1 = md5($sifra);
$ulica = $_POST['ulica'];
$broj = $_POST['broj'];
$telefon = $_POST['telefon'];
    


$upit = "UPDATE korisnik SET ime = '{$ime}', prezime = '{$prezime}', email = '{$email}', korisnicko_ime = '{$korisnicko_ime}', sifra = '{$sifra1}', ulica = '{$ulica}', broj = '{$broj}', telefon = '{$telefon}'  WHERE id = {$id};";
$res = $db->exec($upit);
if (empty($res)) {
    echo"<script>alert('Nije uspela izmena');</script>";
    echo"<script>window.location.href = 'pregled-korisnika.php';</script>";

}



header("Location: pregled-korisnika.php");
}



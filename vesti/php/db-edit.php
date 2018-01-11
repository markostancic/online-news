<?php

require_once __DIR__ . '/baza/DB.php';
$db = new \Baza\DB();

 $id = $_POST['id'];
$ime = $_POST['ime'];
$prezime = $_POST['prezime'];
$tel = $_POST['telefon'];
$email = $_POST['email'];

$upit = "UPDATE korisnik SET ime = '{$ime}', prezime = '{$prezime}', telefon = '{$tel}'  WHERE id = {$id};";
$res = $db->exec($upit);
if (empty($res)) {
    echo"<script>alert('Nije uspela izmena');</script>";
    echo"<script>window.location.href = '../index.php';</script>";

}



header("Location: ../index.php");




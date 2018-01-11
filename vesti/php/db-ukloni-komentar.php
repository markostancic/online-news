<?php

require_once __DIR__ . '/baza/DB.php';
$db = new \Baza\DB();



$id = $_GET['id'];
$upit = "DELETE FROM `komentari` WHERE id = {$id};";
$res = $db->exec($upit);
if (empty($res)) {
    var_dump('nije uspeolo brisanje iz baze');
    die;
}


header("Location: vesti.php?id={$_GET['vesti_id']}");
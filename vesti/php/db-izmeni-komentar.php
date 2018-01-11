<?php
session_start();
    require_once __DIR__.'/baza/DB.php';
    $db = new \Baza\DB();
    
    $id = $_POST['id'];
    $a = $_SESSION['vest'];
    $ime = $_POST['korisnik'];
    $text = $_POST['text'];
    
    $upit = "UPDATE komentari SET korisnik= '{$ime}', text = '{$text}' WHERE id = '{$id}';";
    $res = $db->exec($upit);
    if(empty($res)){
        
    }
    
    header("Location: vesti.php?id={$a}");
?>
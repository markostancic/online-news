<?php
session_start();
require_once __DIR__ . '/baza/DB.php';
$db = new \Baza\DB();
$a = $_SESSION['vest'];
$vest = $db->fetchAll("SELECT * FROM vest WHERE id={$a};");
if(isset($_POST['text']) && isset($_POST['korisnik']))
{
  $comment=$_POST['text'];
  $name=$_POST['korisnik'];
    
    $sql = "INSERT INTO komentari (korisnik,text,datum) "." VALUES ('{$name}', '{$comment}', CURRENT_TIMESTAMP);";
        $res = $db->exec($sql);
        if (empty($res)) {
            var_dump('nije uspeo upis u bazu');
            die;
        }
      $kom = $db->fetchAll("SELECT * FROM komentari WHERE korisnik='{$name}' AND text='{$comment}';");
      foreach ($kom as $row)
            {
          	  $name=$row['korisnik'];
              $comment=$row['text'];
              $time=$row['datum'];

  ?>
<div class="comment_div" id="comm"> 
     <p class="name"><strong>Postavio/la:</strong> <?php echo $name;?> <span style="float:right"><?php echo date("j-M-Y", strtotime($time)) ?></span></p>
        <div class="pull-right">
             <?php
    echo "<a href='izmeni-komentar.php?id={$row['id']}&vesti_id=$a' id='dugme'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>\n";
     echo "<a href='db-ukloni-komentar.php?id={$row['id']}&vesti_id=$a' id='dugme' onclick='if(!confirm(\"Da li ste sigurni?\"))return false;'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a>\n";
    ?>
        </div>
         <p class="comments"><?php echo $comment;?></p>	
</div>
  <?php
  }
exit;
}

?>
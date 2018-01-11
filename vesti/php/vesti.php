<?php
session_start();
	require_once __DIR__ . '/baza/DB.php';
    $db = new \Baza\DB();
    $ime = $_SESSION['id'];
    $rez = $db->fetch("SELECT * FROM korisnik WHERE id='{$ime}';");
?>
    <!DOCTYPE html>
    <html>

    <head>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <title>Detaljnije o vestima</title>
        <?php
        require_once __DIR__ . '/header.php';  
    ?>
            
    </head>

    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top example6">


            <div class="container-fluid">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header" id="menu11">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="../index.php" class="nav-item">Pocetna</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <div class='dropdown' id='lista'>
                            <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' style='color:#fff;' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>Moj nalog
                            <span class='caret' id='strelica'></span>
                        </button>
                            <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>
                                <li><a href="edit.php">Informacije o nalogu</a></li>
                                <li><a href='logout.php?logout=1'>Izloguj se</a></li>
                            </ul>
                        </div>
                    </ul>


                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
        <div class="col-md-6 col-md-offset-3">
            <?php
	require_once __DIR__ . '/baza/DB.php';
    $db = new \Baza\DB();
    $id = $_GET['id'];
    $_SESSION['vest'] = $id;

    $vest = $db->fetchAll("SELECT * FROM vest WHERE id={$id};");
    foreach ($vest as $vesti)
    {   
        echo "<div class='col-md-6' style='margin-top:100px;'>";
        echo " <div class='row vest'>Naslov: {$vesti['naslov']} | Autor: {$vesti['autor']}</div>";
        echo " <div class='row'><img src='../images/".$vesti['slika']."' style='width:250px; height:250px;' ></div>";
        echo "</div>";
        echo "<div class='col-md-6' style='margin-top:115px;'>";
        echo "<div class='vest' >Text:</div>";
        echo "<div>{$vesti['text']}</div>";
        echo "</div>";

    }

?>
        </div>
        <div class="col-md-6 col-md-offset-3" style="margin-top:50px ;">
         <div class="form forma">
          <form method='post' action="" onsubmit="return post();">
              <input type="text" id="korisnik" class="form-control" placeholder="Vaše ime" autocomplete="off">
              <textarea id="text" class="form-control" placeholder="Poruka....."></textarea>  
              <div class="col-md-4 col-md-offset-4" id="polje">
                  <input type="submit" value="Postavi komentar" class="btn btn-lg btn-info">
              </div>
          </form>
        </div>
          <div id="all_comments">
          <?php
        require_once __DIR__ . '/baza/DB.php';
        $db = new \Baza\DB();
              
              $kom = $db->fetchAll("SELECT * FROM komentari;");
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
    echo "<a href='izmeni-komentar.php?id={$row['id']}&vesti_id=$id' id='dugme'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>\n";
     echo "<a href='db-ukloni-komentar.php?id={$row['id']}&vesti_id=$id' id='dugme' onclick='if(!confirm(\"Da li ste sigurni?\"))return false;'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a>\n";
    ?>
        </div>
         <p class="comments"><?php echo $comment;?></p>	
        </div>
  
    <?php
      }

    ?>
  </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="../js/ajax.js"></script>
        <?php
        require_once __DIR__ . '/footer.php';

    ?>
    </body>

    </html>
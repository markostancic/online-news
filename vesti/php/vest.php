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

error_reporting( ~E_NOTICE );

$greske = array();

if (isset($_POST['submit'])) {
    $naslov = isset($_POST['naslov']) ? $db->prepareString($_POST['naslov']) : null;
    if (empty($naslov)) {
        $greske[] = 'Polje za naslov je prazano';
    }
    $autor = isset($_POST['autor']) ? $db->prepareString($_POST['autor']) : null;
    if (empty($autor)) {
        $greske[] = 'Polje autor je prazno';
    }
    $datum = isset($_POST['datum']) ? $db->prepareString($_POST['datum']) : null;
    if (empty($datum)) {
        $greske[] = 'Polje za datum je prazno';
    }
    $text = isset($_POST['text']) ? $db->prepareString($_POST['text']) : null;
    if (empty($text)) {
        $greske[] = 'Polje za text je prazno';
    }
    $slika = isset($_POST['slika']) ? $db->prepareString($_POST['slika']) : null;
    if (empty($slika)) {
        $greske[] = 'Polje za sliku je prazno';
    }
    if (!ctype_alpha($autor)) {
        $greske[] = 'Autor nije dobar';
    }
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $naslov)) { 
        $greske[] = 'Naslov sadrzi nedozvoljene karaktere!.'; 
    }
    
  $imgFile = $_FILES['slika']['name'];
  $tmp_dir = $_FILES['slika']['tmp_name'];
  $imgSize = $_FILES['slika']['size'];
  
   if(empty($imgFile)){
   $errMSG = "Please Select Image File.";
  }
  else
  {
   $upload_dir = 'images/'; // upload directory
 
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
   // rename uploading image
   $userpic = rand(1000,1000000).".".$imgExt;
    
   // allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
    if($imgSize < 5000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$userpic);
    }
    else{
     $greske[] = "Sorry, your file is too large.";
    }
   }
   else{
    $greske[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
   }
  }

    
    if (empty($greske)) { 
        $sql = "INSERT INTO vest (naslov, autor, datum, text, slika) " ." VALUES ('{$naslov}', '{$autor}', '{$datum}', '{$text}', '{$slika}');"; $res = $db->exec($sql); 
        if (empty($res)) { 
            var_dump('nije uspeo upis u bazu'); 
            die; 
        } 
        $info = "Uspesno ste dodali vest!"; 
        $_POST = array(); 
        header("refresh:5;pregled-vesti.php");
        //header("Location: pregled-vesti.php"); 
    } 
    } 
?>

        <!DOCTYPE html>
        <html>

        <head>
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
            <title>Dodavanje vesti</title>
            <meta charset="UTF-8">
        </head>

        <body>
            <h1 class="col-md-4 col-md-offset-4">Dodavanje vesti</h1>
            <div class="forma form-horizontal col-md-6 col-md-offset-3">
                <form action="vest.php" method="post">
                    <p>Naslov <span style="color:red;">*</span><br>
                        <span><input type="text" name="naslov" class="form-control" value="<?php echo isset($_POST['naslov']) ? $_POST['naslov'] : ''?>" size="40"aria-required="true" aria-invalid="false"></span> </p>
                    <p>Autor <span style="color:red;">*</span><br>
                        <span><input type="text" name="autor" class="form-control" value="<?php echo isset($_POST['autor']) ? $_POST['autor'] : ''?>" size="40"aria-required="true" aria-invalid="false"></span> </p>
                    <p>Datum <span style="color:red;">*</span><br>
                        <span><input type="date" name="datum" class="form-control" value="<?php echo isset($_POST['datum']) ? $_POST['datum'] : ''?>" size="40" aria-required="true" aria-invalid="false"></span> </p>
                    <p>Text <span style="color:red;">*</span><br>
                        <span><input type="text" name="text" class="form-control" value="<?php echo isset($_POST['text']) ? $_POST['text'] : ''?>" size="40"aria-required="true" aria-invalid="false"></span> </p>
                    <p>Slika <span style="color:red;">*</span><br>
                        <span><input class="input-group" type="file" name="slika" accept="images/*" /></span> </p>
                    <div class="col-md-4 col-md-offset-4">
                        <tr><input type="submit" name="submit" class="btn btn-md btn-success dugme2" value="Dodajte">
                            <a href="../admin/index.php" class="btn btn-md btn-warning dugme2">Nazad</a></tr>
                        <p><span style="color:red;">*</span>
                            <?php echo isset($info) ? $info : 'obavezno polje'?>
                        </p>
                    </div>
                </form>
                <div class="col-md-4 col-md-offset-4" id="greske">
                    <?php
        if (!empty($greske)) {
            foreach ($greske as $greska) {
                echo $greska . '<br>';
            }
        }
        ?>
                </div>

            </div>
            <?php
}
?>
        </body>

        </html>
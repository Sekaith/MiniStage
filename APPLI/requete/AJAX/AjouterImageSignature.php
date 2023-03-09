<?php
require_once('../../Class/autoload.php');
require_once('../../Class/Connexion.class.php');

$target_dir = "../../image/signatures/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        $uploadOk = 0;
    }
}
if ($_FILES["file"]["size"] > 500000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if ($uploadOk == 1) {
    if (file_exists($target_file)) {
        unlink($target_file);
    }
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) ;
}

global $mysqli;
$rqt = "UPDATE t_etablissement SET cachet = '".$_FILES["file"]["name"]."' WHERE idetab=".$_POST["idetab"];
$Confirm = $mysqli->query($rqt);

?>

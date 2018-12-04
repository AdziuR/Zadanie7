<?php
$ciasto=$_COOKIE['nazwisko'];
$sciezka=$_POST['folder'];
if (is_uploaded_file($_FILES['plik']['tmp_name']))
{
    if(IsSet($sciezka)){
        move_uploaded_file($_FILES['plik']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."zadanie7/$ciasto".$_FILES['plik']['name']);
    }else{
     move_uploaded_file($_FILES['plik']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."zadanie7/$ciasto/".$_FILES['plik']['name']);
    }
}
header("Location: wyslij.html");
?>
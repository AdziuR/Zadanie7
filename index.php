<?php

    $dbhost="serwer1841863.home.pl"; $dbuser="28879820_cloud"; $dbpassword="Adrian14@"; $dbname="28879820_cloud";
    $polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
	if (!$polaczenie) {
	echo "Błąd połączenia z MySQL." . PHP_EOL;
	echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Error: " . mysqli_connect_error() . PHP_EOL;
	exit;
	}
    
$ciasto = $_COOKIE['nazwisko'];
$plik= $_POST['plik'];
$folder=$_POST['folder'];

if($folder==$ciasto){
    $plik= $_POST['plik'];
if (isset($_POST['wyslij'])){
$max_rozmiar = 5000;
if (is_uploaded_file($_FILES['plik']['tmp_name']))
{
if ($_FILES['plik']['size'] > $max_rozmiar) {echo "Przekroczenie rozmiaru $max_rozmiar"; }
else
{
echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>';
if (isset($_FILES['plik']['type'])) {echo 'Typ: '.$_FILES['plik']['type'].'<br/>'; }
move_uploaded_file($_FILES['plik']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/zadanie7/$ciasto/".$_FILES['plik']['name']);
}
}

else {echo 'Błąd przy przesyłaniu danych!';}
}
} 
 else{
 $plik= $_POST['plik'];
if (isset($_POST['wyslij'])){
$max_rozmiar = 5000;
if (is_uploaded_file($_FILES['plik']['tmp_name']))
{
if ($_FILES['plik']['size'] > $max_rozmiar) {echo "Przekroczenie rozmiaru $max_rozmiar"; }
else
{
echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>';
if (isset($_FILES['plik']['type'])) {echo 'Typ: '.$_FILES['plik']['type'].'<br/>'; }
move_uploaded_file($_FILES['plik']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/zadanie7/$ciasto/$folder/".$_FILES['plik']['name']);
}
}

else {echo 'Błąd przy przesyłaniu danych!';}
}
}
?>

<html>
<body>
<center>
Zostałeś zalogowany jako:<b> <?php  echo $ciasto; ?></b>
<p><a href="wyloguj.php">Wyloguj</a></p>
</center>
<br></br>
<hr></hr>
Prześlij swój plik na chmure do wybranego katalogu:
<br></br>
<form action="<?php echo $_SERVER['PHP_self']; ?> " method="POST" ENCTYPE="multipart/form-data"> 
<select name="folder" >
<option value="<?php echo "$ciasto"?> "><?php echo "$ciasto"?></option>
<?php
chdir("./$ciasto/");
foreach (glob("*",GLOB_ONLYDIR) as $folder){
    if ($folder!="FILES"){
        echo "<option value ='".$folder."'>".$folder."</option>";
        
    }
    
}

?>
</select>

<input type="file" name="plik"/> 
<input type="submit" value="Wyślij plik" name="wyslij"/>
<br></br>
<hr></hr>
Lista plików oraz katalogów w katalogu <b> <?php  echo $ciasto; ?> </b>:
<br>
<?php
$dir= "/zadanie7/$ciasto";
$files = scandir($dir);
$arrlength = count($files);
for($x = 2; $x < $arrlength; $x++) {
      echo "<br>";
  if (is_file("/zadanie7/$ciasto/$files[$x]")){
    echo "<a href='/zadanie7/$ciasto/$files[$x]' download='$files[$x]'>$files[$x]</a><br>";
  }else{ 
      echo $files[$x],"<br>";
      $dir2= "/zadanie7/$ciasto/$files[$x]";
      $files2 = scandir($dir2);
      $arrlength2 = count($files2);
        for($y = 2; $y < $arrlength2; $y++) {
        
        if (is_file("/zadanie7/$ciasto/$files[$x]/$files2[$y]")){
          
        echo "<a href='/zadanie7/$ciasto/$files[$x]/$files2[$y]' download='$files2[$y]'>$files2[$y]</a>";
        
        }else{ 
            echo "",$files2[$y];
        }
            echo "<br>";
            }
   }
  }
?>
</form> 
<hr></hr>
<p>Stwórz katalog</p>
<form method="POST" action="<?php echo $_SERVER['PHP_self']; ?> ">
        Nazwa:<input type="text" name="nazwakatalogu">
        <input type="submit" value="Stwórz"/>
<?php 
if (isset($_POST['nazwakatalogu'])){
$nazwa=$_POST['nazwakatalogu'];
$ciasto=$_COOKIE['nazwisko'];
mkdir ("/zadanie7/$ciasto/$nazwa", 0777);
}
?>        
</form>

</body>
</html>
<?php

    $dbhost="serwer1841863.home.pl"; $dbuser="28879820_cloud"; $dbpassword="Adrian14@"; $dbname="28879820_cloud";
	$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
	if (!$polaczenie) {
	echo "Błąd połączenia z MySQL." . PHP_EOL;
	echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Error: " . mysqli_connect_error() . PHP_EOL;
	exit;
	}
//****************** LOGI    
$ipaddress = $_SERVER["REMOTE_ADDR"];
function ip_details($ip) {
$json = file_get_contents ("http://ipinfo.io/{$ip}/geo");
$details = json_decode ($json);
return $details;
}
$details = ip_details($ipaddress);
$ip=$details -> ip;
$godzina = date("Y-m-d H:i:s", time());

$zliczanielogow=mysqli_query($polaczenie, "SELECT COUNT(*) FROM `logi` WHERE ipadres LIKE '$ip' AND (CURRENT_TIMESTAMP - `nieudane`) < 120");
$zliczanie = mysqli_fetch_array($zliczanielogow, MYSQLI_NUM); 

if ($zliczanie[0] < 3){
	if (isset($_POST['loguj'])) {
		$user=$_POST['nazwisko']; // login z formularza
		$pass=$_POST['haslo']; // hasło z formularza
    
		$result = mysqli_query($polaczenie, "SELECT * FROM users WHERE nazwisko='$user'"); // pobranie z BD wiersza, w którym login=login z formularza
		$rekord = mysqli_fetch_array($result); // wiersza z BD, struktura zmiennej jak w BD
		if(!$rekord) //Jeśli brak, to nie ma użytkownika o podanym loginie
			{
			mysqli_close($polaczenie); // zamknięcie połączenia z BD
			echo "Brak użytkownika o takim loginie !"; // UWAGA nie wyświetlamy takich podpowiedzi dla hakerów
			}
		else
		{ // Jeśli $rekord istnieje
			if($rekord['haslo']==($pass)) // czy hasło zgadza się z BD
			{
       $ipadres = $_SERVER["REMOTE_ADDR"];
          $result = mysqli_query($polaczenie, "SELECT * FROM users WHERE nazwisko='$user'"); // pobranie z BD wiersza, w którym login=login z formularza
       while($wiersz = mysqli_fetch_array($result)){
           $idu=$wiersz[0];  
       }
       $query="INSERT INTO logi VALUES ('','$idu',CURRENT_TIMESTAMP,'','$ipadres')";
      $logiklienta=mysqli_query($polaczenie, $query );
     
    $ciasto = $_POST['nazwisko'];
         setcookie('nazwisko',$ciasto, time()+600);
      header("Location: index.php");
            }
			else
			{
		 $ipadres = $_SERVER["REMOTE_ADDR"];
          $result = mysqli_query($polaczenie, "SELECT * FROM users WHERE nazwisko='$user'"); // pobranie z BD wiersza, w którym login=login z formularza
       while($wiersz = mysqli_fetch_array($result)){
           $idu=$wiersz[0];  
       }
       $query2="INSERT INTO logi (id, idu, udane, nieudane, ipadres ) VALUES (' ','$idu','',CURRENT_TIMESTAMP,'$ipadres')";
        $logiklientafail=mysqli_query($polaczenie,$query2);
			 echo ("ZŁE HASLO");
            }
		}
	}

}
else { echo (" TWOJE KONTO ZOSTAŁO ZAWIESZONE NA 2 MINUTY"); }
?>
   
<!DOCTYPE html>
<html>
<head>
  <title>Wiśniewski</title>
  <link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
  <div class="header">
      <h2>Login</h2>
  </div>
     
  <form method="post" action="loguj.php">

  	<div class="input-group">
  		<label>Nazwa użytkownika</label>
  		<input type="text" name="nazwisko" >
  	</div>
  	<div class="input-group">
  		<label>Hasło</label>
  		<input type="password" name="haslo">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="loguj">Login</button>
  	</div>
  	<p>
  		Nie masz konta? <a href="rejestracja.php">Zarejestruj się</a>
  	</p>
  </form>    
    
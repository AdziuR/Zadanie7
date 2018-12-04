<html>
<head>
  <title>Wiśniewski</title>
  <link rel="stylesheet" type="text/css" href="style1.css">

</head>
<body>
 <?php
    $dbhost="serwer1841863.home.pl"; $dbuser="28879820_cloud"; $dbpassword="Adrian14@"; $dbname="28879820_cloud";
    $polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
    if (!$polaczenie) {
	echo "Błąd połączenia z MySQL." . PHP_EOL;
	echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Error: " . mysqli_connect_error() . PHP_EOL;
	exit;
	}

 $rejestr= $_POST['rejestr'];
	if (isset($rejestr))
	{
	   $nazwisko = $_POST['nazwisko'];
	   $haslo1 =$_POST['haslo1'];
	   $haslo2 =$_POST['haslo2'];
	   $zapytanie = mysqli_query($polaczenie,"SELECT nazwisko FROM users WHERE nazwisko = '$nazwisko' ");
		$wiersze = mysqli_num_rows ($zapytanie);
	   if ($wiersze == 0)
	   {
		  if ($haslo1 == $haslo2)
		  {
			 $zapytanie2 = mysqli_query($polaczenie,"INSERT INTO users (nazwisko, haslo)	VALUE ('$nazwisko','$haslo1')");
           
           echo "Konto zostało utworzone! Przejdź do strony logowania! ";
        $folder = $_POST['nazwisko'];
        mkdir ("../zadanie7/$folder", 0777);  
          echo "<b>Folder o nazwie: <i>$folder</i> został stworzony!</b>";
		  }
		  else echo "Podane hasła nie są zgodne !";
	   }
	   else echo "Wybrany login jest już zajęty !";
	}
    
?>

 
 <div class="header">
      <h2>Rejestracja</h2>
  </div>
	
  <form method="post" action="<?php echo $_SERVER['PHP_self']; ?>">
  	<div class="input-group">
  	  <label>Nazwa użytkownika</label>
  	  <input type="text" name="nazwisko" value="<?php echo $nazwisko; ?>">
  	</div>
  
  	<div class="input-group">
  	  <label>Hasło</label>
  	  <input type="password" name="haslo1">
  	</div>
  	<div class="input-group">
  	  <label>Powtórz hasło</label>
  	  <input type="password" name="haslo2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="rejestr" >Zarejestruj</button>
  	</div>
  	<p>
  		Masz już konto? <a href="loguj.php">Zaloguj</a>
  	</p>
  </form>
  
</body>
</html>

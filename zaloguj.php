<html>
<?php

session_start();
if ((!isset($_POST['pesel'])) || (!isset($_POST['haslo']))) 
	{
		header('Location: index.php');
		exit();
	}
require_once "config.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else 
	{

	$pesel = $_POST['pesel'];
	$haslo = $_POST['haslo'];

	$pesel = htmlentities($pesel, ENT_QUOTES, "UTF-8");
	$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

	$rezultat = @$polaczenie->query(sprintf(
		"SELECT * FROM uzytkownicy WHERE pesel='%s' AND haslo='%s'",
		mysqli_real_escape_string($polaczenie,$pesel),
		mysqli_real_escape_string($polaczenie,$haslo)
	));
		if($rezultat)
		{
			$ile_userow = $rezultat->num_rows;
			if($ile_userow > 0)
			{
				$_SESSION['zalogowany'] = true;
				
				$wiersz = $rezultat->fetch_assoc();
				
				$_SESSION['id'] = $wiersz['id'];
				$_SESSION['user'] = $wiersz['imie'];
				$_SESSION['nazwisko'] = $wiersz['nazwisko'];
				$_SESSION['pesel'] = $wiersz['pesel'];
				$_SESSION['email'] = $wiersz['email'];
				$_SESSION['saldo_konta'] = $wiersz['saldo_konta'];

				unset($_SESSION['blad']);
				$rezultat->close();
				header('Location: konto.php');
			}
			else
			{
					$_SESSION['blad'] = "Blad logowania, nieprawidlowy pesel lub haslo";
					header('Location: index.php');
			}
		}
	}
	
	$polaczenie->close();

?>
</html>
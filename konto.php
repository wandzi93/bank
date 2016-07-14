<?php

	session_start();

	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	} 

	echo "Witaj, ".$_SESSION['user']." ".$_SESSION['nazwisko']."! :)";
	echo "<br><br><br>";
	echo "Twoj numer pesel to: ".$_SESSION['pesel'];
	echo "<br>";
	echo "Twoj e-mail to: ".$_SESSION['email'];
	echo "<br>";
	echo "<br>";
	echo "Twoj stan gotowki wynosi: ".$_SESSION['saldo_konta']." zl";
	echo "<br>";
	echo "<br>";
	echo '<a href="logout.php">[ Wyloguj sie ]</a>';

?>
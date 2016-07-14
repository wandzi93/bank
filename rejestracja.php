<?php

  session_start();

  if (isset($_POST['email']))
  {
  	// Udana walidacja
  	$wszystko_ok = true;

  	//Sprawdzenie poprawnosci nr Pesel
  	$pesel = $_POST['pesel'];

	//Sprawdzenie dlugosci nr Pesel
	  	if ((strlen($pesel) != 11) || (!is_numeric($pesel)))
	  	{
	  		$wszystko_ok = false;
	  		$_SESSION['blad_pesel'] = "Twoj numer PESEL musi posiadac 11 cyfr i skladac sie z liczb.";
	  	}

	//Sprawdzenie email'a
  	$email = $_POST['email'];
  	$emailsprawdzony = filter_var($email, FILTER_SANITIZE_EMAIL);

	  	if ((filter_var($emailsprawdzony, FILTER_VALIDATE_EMAIL) == false) || ($emailsprawdzony != $email))
	  	{
	  		$wszystko_ok = false; 
	  		$_SESSION['blad_email'] = "Twoj adres e-mail jest niepoprawny.";
	  	}

	//Sprawdzanie hasel

  	$haslo1 = $_POST['haslo1'];
  	$haslo2 = $_POST['haslo2'];

  		if((strlen($haslo1) < 8 ) || (strlen($haslo1) > 20))
  		{
  			$wszystko_ok = false;
  			$_SESSION['blad_haslo1'] = "Haslo musi posiadac od 8 do 20 znakow.";
  		}

  		if($haslo1 != $haslo2)
  		{
  			$wszystko_ok = false;
  			$_SESSION['blad_haslo2'] = "Musisz wpisac identyczne hasla.";
  		}

  		if(isset($_POST['regulamin']))
  		{
  			$wszystko_ok = $wszystko_ok;
  		}
  		else
  		{
  			$wszystko_ok = false;
  		}

	  	if ($wszystko_ok = true) 
	  	{
	  		//Dodanie konta do bazy
	  		echo "Udalo sie";
	  		exit();
	  	}	 
  }
?>

<script src='https://www.google.com/recaptcha/api.js'></script>

<div style="margin: 0 auto; width: 500px;">
	<div style="width: 500px; height: 500px; text-align: center;">
		<form method="post">
			<fieldset>
		        <legend>Rejestracja:</legend>
		        	<br>

		            Numer pesel:

		            <input type="text" name="pesel"><br><br>
			            <?php
			            	if(isset($_SESSION['blad_pesel']))
			            	{
			            		echo '<div style="color:red;">'.$_SESSION['blad_pesel']."</div><br>";
			            		unset($_SESSION['blad_pesel']);
			            	}
			            ?>

		            E-mail:

		            <input type="text" name="email"><br><br>
		            	<?php
			            	if(isset($_SESSION['blad_email']))
			            	{
			            		echo '<div style="color:red;">'.$_SESSION['blad_email']."</div><br>";
			            		unset($_SESSION['blad_email']);
			            	}
			            ?>

		            Twoje haslo:

		            <input type="password" name="haslo1"><br><br>
		            	<?php
			            	if(isset($_SESSION['blad_haslo1']))
			            	{
			            		echo '<div style="color:red;">'.$_SESSION['blad_haslo1']."</div><br>";
			            		unset($_SESSION['blad_haslo1']);
			            	}
			            ?>

		            Powtorz haslo:

		            <input type="password" name="haslo2"><br><br>
		            		<?php
			            	if(isset($_SESSION['blad_haslo2']))
			            	{
			            		echo '<div style="color:red;">'.$_SESSION['blad_haslo2']."</div><br>";
			            		unset($_SESSION['blad_haslo2']);
			            	}
			           		?>

		            <label>
		            	<input type="checkbox" name="regulamin"> Akceptuje regulamin.<br><br>
		            </label>
		            <div class="g-recaptcha" data-sitekey="6LdvriQTAAAAAEDSPiTB519MYrWPxCLuJOON5w03"></div><br>
		            <input type="submit" value="Zarejestruj sie">
		     </fieldset>
	       </form>
	</div>
</div>	 

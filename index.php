<?php
    session_start();
    if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true))
      {
        header('Location: konto.php');
        exit();
      }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Strona banku</title>
</head>
<body>
  <h1 style="text-align: center;">Witamy na stronie banku</h1>
  <br> <br>
  <div style="margin: 0 auto; width: 300px;">
    <div style="width: 300px; height: 100px; text-align: center;">

      <form action="zaloguj.php" method="post">
        <fieldset>
          <legend>Logowanie:</legend><br>
            <input type="text" name="pesel" placeholder="Numer pesel"><br><br>
            <input type="password" name="haslo" placeholder="Haslo"><br>
            <br><br>
            <input type="submit" value="Zaloguj sie">
              <?php
                 echo "<br><br>";
                 if (isset($_SESSION['blad'])) 
                 {
                  echo $_SESSION['blad'];
                 }
              ?>
            <a href="rejestracja.php">Zarejestruj się.</a>  
        </fieldset>
      </form>
      
    </div>
  </div>
</body>
</html>
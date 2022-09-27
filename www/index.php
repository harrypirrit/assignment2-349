<!DOCTYPE HTML>
<html>
  <head>
    <h1 id="demo"> Currency Converter </h1>
  </head>

  <body>
  <p> <?php $currency = file_get_contents("http://192.168.2.13?currency=NZD");?></p>


  <?php

    session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Convert'])){
        update_db();
    }

  function update_db(){
      $currency = $_POST['currency'];
      $database_host = '192.168.2.12';
      $database_name = 'currencies';
      $database_user = 'user';
      $databse_password = 'root123';

      $pdo_dsn = "mysql:host=$database_host;dbname=$database_name";

      $pdo = new PDO($pdo_dsn, $database_user, $databse_password);

       if($currency == "NZD"){
        $NZD = file_get_contents("http://192.168.2.13?currency=NZD");
        $_SESSION['currencies'] = "<p> New Zealand Dollar: $NZD </p>";
        $q = $pdo->query("UPDATE currencies SET defaultCurrency = 'NZD' WHERE userID='User'");
      } else if($currency == "AUD"){
      $AUD = file_get_contents("http://192.168.2.13?currency=AUD");
      $_SESSION['currencies'] = "<p> Australian Dollar: $AUD </p>";
      $q = $pdo->query("UPDATE currencies SET defaultCurrency = 'AUD' WHERE userID='User'");

    } else if($currency == "USD"){
        $USD = file_get_contents("http://192.168.2.13?currency=USD");
        $_SESSION['currencies'] = "<p> United States Dollar: $USD </p>";
        $q = $pdo->query("UPDATE currencies SET defaultCurrency = 'USD' WHERE userID='User'");

    } else if($currency == "GBP"){
        $GBP = file_get_contents("http://192.168.2.13?currency=GBP");
        $_SESSION['currencies'] = "<p> Great British Pound: $GBP </p>";
        $q = $pdo->query("UPDATE currencies SET defaultCurrency = 'GBP' WHERE userID='User'");

    } else if($currency == "KRW"){
        $KRW = file_get_contents("http://192.168.2.13?currency=KRW");
        $_SESSION['currencies'] = "<p> South Korean Won: $KRW </p>";
        $q = $pdo->query("UPDATE currencies SET defaultCurrency = 'KRW' WHERE userID='User'");
    }
}

?>
  <form action="index.php" method="post">

            <p> Convert 1.00 NZD to:
            <select name="currency">
          <option value="NZD" <?php getSelectSession("currency", "NZD"); ?>>New Zealand Dollar</option>
          <option value="AUD" <?php getSelectSession("currency", "AUD"); ?>>Australian Dollar</option>
          <option value="USD" <?php getSelectSession("currency", "USD"); ?>>United States Dollar</option>
          <option value="GBP" <?php getSelectSession("currency", "GBP"); ?>>Great British Pound</option>
          <option value="KRW" <?php getSelectSession("currency", "KRW"); ?>>South Korean Won</option>
        </select>

        <input type="submit" name="Convert" value="Convert"></input>

        </form>

  

<?php
    $database_host = '192.168.2.12';
    $database_name = 'currencies';
    $database_user = 'user';
    $databse_password = 'root123';

    $pdo_dsn = "mysql:host=$database_host;dbname=$database_name";

    $pdo = new PDO($pdo_dsn, $database_user, $databse_password);


    $query = $pdo->query("SELECT * FROM currencies");

    while($row = $query->fetch()){
        $default_currency = $row['defaultCurrency'];

        if($default_currency == $currency){
            header('refresh: 0;');
        }
        }

        ?>
        
        <?php

        function getSelectSession($val, $val2)
        {
        if ($_SESSION[$val] == $val2) {
        echo "selected";
        }
        }
        ?>

        

        <?php
          echo $_SESSION['currencies'];
          $_SESSION['currencies'] = "";
          ?>





</body>
</html>
    
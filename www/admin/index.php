<html>
<?php

   // connect to DB
    $database_host = '192.168.2.12';
    $database_name = 'kounters';
    $database_user = 'user';
    $databse_password = 'root123';

    $pdo_dsn = "mysql:host=$database_host;dbname=$database_name";

    $pdo = new PDO($pdo_dsn, $database_user, $databse_password);

    $NZDcount = $pdo->query("SELECT tally from kounters WHERE id = 'NZD'");
    $AUDcount = $pdo->query("SELECT tally from kounters WHERE id = 'AUD'");
    $USDcount = $pdo->query("SELECT tally from kounters WHERE id = 'USD'");
    $GBPcount = $pdo->query("SELECT tally from kounters WHERE id = 'GBP'");
    $KRWcount = $pdo->query("SELECT tally from kounters WHERE id = 'KRW'");
  


    // set the base and currency values 
    $base = 1;
    $NZD = 1;
    $AUD = 0.89;
    $USD = 0.62;
    $GBP = 0.52;
    $KRW = 807.31;

    // conditionals for each POSTed currency
    if(strcmp($_GET['currency'], "NZD" ) == 0){
      $converted = $base * $NZD;
      $pdo->query("UPDATE kounters SET tally = tally+1 WHERE id = 'NZD'");
      echo $converted;
      }

    else if(strcmp($_GET['currency'], "AUD" ) == 0){
      $converted = $base * $AUD;
      $pdo->query("UPDATE kounters SET tally = tally+1 WHERE id = 'AUD'");
      echo $converted;
    }
    
    else if(strcmp($_GET['currency'], "USD" ) == 0){
      $converted = $base * $USD;
      $pdo->query("UPDATE kounters SET tally = tally+1 WHERE id = 'USD'");
      echo $converted;
      }

      else if(strcmp($_GET['currency'], "KRW" ) == 0){
        $pdo->query("UPDATE kounters SET tally = tally+1 WHERE id = 'KRW'");
        $converted = $base * $KRW;
        echo $converted;
        }

   else if(strcmp($_GET['currency'], "GBP" ) == 0){
      $pdo->query("UPDATE kounters SET tally = tally+1 WHERE id = 'GBP'");
      $converted = $base * $GBP;
      echo $converted;
      }

    else{
      showForm($NZDcount, $AUDcount, $USDcount, $GBPcount, $KRWcount);
    }
     ?> 
    
      <?php
      function showForm($NZDcount, $AUDcount, $USDcount, $GBPcount, $KRWcount){
        ?>
        <h1> Admin View </h1>
        <hr>
        <h3> Number of NZD to NZD Conversions : <?php echo $NZDcount->fetch()["tally"] ?> </h3>
        <h3> Number of NZD to AUD Conversions : <?php echo $AUDcount->fetch()["tally"] ?> </h3>
        <h3> Number of NZD to USD Conversions : <?php echo $USDcount->fetch()["tally"] ?> </h3>
        <h3> Number of NZD to GBP Conversions : <?php echo $GBPcount->fetch()["tally"] ?> </h3>
        <h3> Number of NZD to KRW Conversions : <?php echo $KRWcount->fetch()["tally"] ?> </h3>
      <?php
        }
      ?>
      </html>

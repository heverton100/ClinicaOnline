<?php

class ConexaoOO {

  function connection()
  {
    $servername = "bggac0murcgmafe7ntgd-mysql.services.clever-cloud.com";
    $username = "ujlluk9853xfym67";
    $password = "Wd5s56K6PRhdzsRF3FWk";

    $banco = "bggac0murcgmafe7ntgd";

    // Create connection
    $conn = new mysqli($servername, $username, $password,$banco);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
  }

}

?>
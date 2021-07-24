<?php

class ConexaoOO{

  function connection()
  {
    $servername = "localhost";
    $username = "root";
    $password = "";

    $banco = "db_clinic";

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
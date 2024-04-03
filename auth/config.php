<?php

      // Database
      $servername = "localhost";
      $username = "root";
      $password = "";
      $db_name = "authsys";


      // Create connection
      $conn = mysqli_connect($servername, $username, $password, $db_name);

      // Check connection
      if (!$conn) {
        exit("Connection failed: " . mysqli_connect_error());
      }

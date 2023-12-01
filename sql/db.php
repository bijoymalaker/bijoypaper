<?php
          $hostname = 'localhost';
          $username = 'root';
          $password = '';
          $dbname = 'bijoypaper';
          $conn = mysqli_connect($hostname, $username, $password, $dbname);
          if ($conn) {
            // echo "Database Connected";
          } else {
            die("Db connection failed!" . mysqli_error($connect));
          }


?>
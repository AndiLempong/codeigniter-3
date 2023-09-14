<?php
  $servername = "localhost:3306";
  $username_db = "root";
  $password_db = "";
  $database_name = "db_sekolah";


  $conn = new mysqli($servername, $username_db, $password_db, $database_name);

  if ($conn->connect_error) {
    die("Congratulation: " . $conn->connect_error);
    }
?>
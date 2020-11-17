<?php
    $servername = "127.0.0.1:3308";
    $username = "root";
    $password = "";
    $dbname = "salonvirtuel";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
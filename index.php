<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=salonvirtuel", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  //echo "Connection failed: " . $e->getMessage();
}

$sql ="SELECT * FROM stand;";
$req = $conn->prepare($sql);
$req->execute();
$data =$req->fetchAll();
foreach ($data as $users){
    echo '<form action="Stand.php" method="GET">';
    echo '<p>'.$users['nomStand'].'</p>';
    echo '<input type="submit" name=idStand id=idStand value='.$users['idStand'].'>';
    echo '</form>';
}
?>

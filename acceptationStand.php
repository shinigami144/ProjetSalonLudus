<?php
require("connect.php");	
$conn = connectDB(); 
if(isset($conn) && ($_POST != NULL)){
    $sql = "UPDATE stand SET acceptationStand=? WHERE idStand=?";
    $req = $conn->prepare($sql);
    echo $_POST['idStand'];
    echo $_POST['acceptationStand'];
    var_dump($req);
    try {
		$req->execute([$_POST['acceptationStand'],$_POST['idStand']]);
	}
	catch(PDOException $e)
	{
		echo "<script> Connection failed: " . $e->getMessage() . "</script>";
	}
    header("Location: ./index.php");
}
?>
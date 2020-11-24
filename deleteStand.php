<?php
require("connect.php");	
$conn = connectDB(); 
if(isset($conn) && ($_POST != NULL)){
    $sql = "DELETE FROM stand WHERE idStand=?";
    $req = $conn->prepare($sql);
    echo $_POST['idStand'];
    var_dump($req);
    try {
		$req->execute([$_POST['idStand']]);
	}
	catch(PDOException $e)
	{
		echo "<script> Delete failed: " . $e->getMessage() . "</script>";
	}
    header("Location: ./index.php");
}
?>
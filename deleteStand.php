<?php
require("connect.php");	
$conn = connectDB(); 
if(isset($conn) && ($_POST != NULL)){
    $sql = "DELETE FROM stand WHERE idStand=?";
    $sql2 = "DELETE FROM adminstand Where idStand=?";
    $sql3 ="DELETE FROM fichier where idStand=?";
    $req = $conn->prepare($sql);
    $req2 = $conn->prepare($sql2);
    $req3 = $conn->prepare($sql3);
    echo $_POST['idStand'];
    var_dump($req);
    try {
        $req3->execute([$_POST['idStand']]);
        $req2->execute([$_POST['idStand']]);
        $req->execute([$_POST['idStand']]);
	}
	catch(PDOException $e)
	{
		echo "<script> Delete failed: " . $e->getMessage() . "</script>";
	}
    header("Location: ./index.php");
}
?>
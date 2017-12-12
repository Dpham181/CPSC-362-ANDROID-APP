<?php
$DBhost = "localhost";
$DBuser ="dpham181";
$DBpass ="Danh2610";
$DBname ="DANHPHAM";

try{
  
  $conn = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
   $operation = $_POST['action'];
  
  if ($operation == "Add Item")
  {
  $stmt1 = $conn->prepare("INSERT INTO FOODS (ITEM, PRICE, DESCRIPTION) VALUES (:name, :price, :desc)");
    $stmt1->bindParam(':name', $name);
    $stmt1->bindParam(':price', $price);
    $stmt1->bindParam(':desc', $desc);

    $name = $_POST['itemName'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];
    $stmt1 -> execute();
}
  elseif ($operation == "Remove Item")
  {
    $stmt2 = $conn->prepare("DELETE FROM FOODS WHERE ID = :idNum");
    	$stmt2->bindParam(':idNum', $idNum);
   		$idNum = $_POST['itemNumber'];
    	$stmt2 -> execute();
  }
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
header("HTTP/1.1 303 See Other");
header("Location: foodAdmin.php");
?>
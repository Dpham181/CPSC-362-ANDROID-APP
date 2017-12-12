<?php

try{
  
  $conn = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $operation = $_POST['operation'];
  
  if ($operation == 1) //1=open 0=close
  {
	  $sql1= "Select currentOrderNumber from TableTracker where tableNumber = 0";
	  $stmt1 = $conn->query($sql1);
	  $result1 = $stmt1->fetchObject();
	  $orderNumber =  $result1->currentOrderNumber;
	  $sql2 = "Update TableTracker set openStatus = 1, currentOrderNumber = $orderNumber where tableNumber = ?";
	  $stmt2 = $conn->prepare($sql2);
	  $stmt2 -> execute(array($_POST['tableNumber']));
	  ++$orderNumber;
	  $sql3 = "Update TableTracker set currentOrderNumber = $orderNumber where tableNumber = 0";
	  $stmt3 = $conn->prepare($sql3);
	  $stmt3 -> execute();
	  echo "Table Opened";
  }
  elseif ($operation == 0)
  {
	  $sql = "Update TableTracker set openStatus = 0, currentOrderNumber = 0 where tableNumber = ?";
	  $stmt = $conn->prepare($sql);
	  $stmt -> execute(array($_POST['tableNumber']));
	  echo "Table Closed";
  } 
}
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
?>

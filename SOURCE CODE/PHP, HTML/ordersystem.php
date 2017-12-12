<?php


try{
  
  $conn = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $stmt = $conn->prepare("INSERT INTO OrderHistory (Item, Price, UserName, Quantity, OrderNumber)
VALUES (:menuItem, :price, :userName, :quantity, :orderNumber)");
    $stmt->bindParam(':menuItem', $menuItem);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':userName', $userName);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':orderNumber', $orderNumber);

    $menuItem = $_POST['menuItem'];
    $price = $_POST['price'];
    $userName = $_POST['userName'];
    $quantity = $_POST['quantity'];
    $orderNumber = $_POST['orderNumber'];
    $stmt -> execute();

echo "New records created successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
?>

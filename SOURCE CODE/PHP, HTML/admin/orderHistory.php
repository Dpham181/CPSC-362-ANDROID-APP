<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Order Number</th><th>Item</th><th>Price</th><th>Quantity</th><th>Submit Time</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$DBhost = "localhost";
$DBuser ="dpham181";
$DBpass ="Danh2610";
$DBname ="DANHPHAM";

try {
    $conn = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT OrderNumber, Item, Price, Quantity, SubmitTime FROM OrderHistory order by orderNumber, SubmitTime"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
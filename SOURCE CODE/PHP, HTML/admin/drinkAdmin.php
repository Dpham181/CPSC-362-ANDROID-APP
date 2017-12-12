<table style='border: solid 1px black;'>
<tr><th>ID</th><th>Item</th><th>Price</th><th>Desc</th></tr>
<?php

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


    $conn = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM DRINKS order by id"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
	$conn = null;
	?>	
</table>
<br>
<form method="post" action="drinkOps.php">
Item Name:<br><input type="text" name="itemName" maxlength=20><br>
Price:<br><input type="text" name="price"><br>
Description:<br><input type="text" name="desc" maxlength=60><br>
<input type="submit" value="Add Item" name="action">
</form>
<br>
Delete Item ID:
<form method="post" action="drinkOps.php">
<input type="text" name="itemNumber"><br>
<input type="submit" value="Remove Item" name="action">
</form>
<?php
$DBhost = "";
$DBuser ="";
$DBpass ="";
$DBname ="";

try{
  
  $DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpass);
  $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
 }catch(PDOException $ex){
  
  die($ex->getMessage());
 }

$stmt = $DBcon -> prepare("SELECT * FROM DRINKS");
$stmt -> execute();

$itemArray = array();

while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
  
      $itemArray['object']['drinks'][] = $row;
}

echo json_encode($itemArray);

$conn= null;

?>

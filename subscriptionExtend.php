<?php
require_once("session.php");
require_once("included_functions.php");
require_once("database.php");
new_header("Online Game Store");

$mysqli = Database::dbConnect();
  $mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  if (($output = message()) !== null) {
  echo $output;
}

  if (isset($_GET["id"]) && $_GET["id"] !== "") {

    $query1 = "UPDATE order_game SET endDate = DATE_ADD(endDate, INTERVAL 1 month) WHERE orderID = ?";
    $stmt1 = $mysqli->prepare($query1);
    $id = $_GET["id"];

    $stmt1->execute([$id]);

  }

  redirect("customerView.php");

$stmt -> close();
Database::dbDisconnect();
?>

<?php
require_once("session.php");
require_once("included_functions.php");
require_once("database.php");
new_header("Online Game Store");

$mysqli = Database::dbConnect();
  $mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$_SESSION["message"] = $_GET["id"];
  if (($output = message()) !== null) {
  echo $output;
}

  if (isset($_GET["id"]) && $_GET["id"] !== "") {

    $query = "DELETE FROM order_game WHERE orderID =
    ANY(SELECT orderID from cOrder WHERE customerID = ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->execute([$_GET["id"]]);

    $query2 = "DELETE FROM cOrder WHERE customerID = ?";
    $stmt2 = $mysqli->prepare($query2);
    $stmt2->execute([$_GET["id"]]);

    $query3 = "DELETE FROM customer WHERE customerID = ?";
    $stmt3 = $mysqli->prepare($query3);
    $stmt3->execute([$_GET["id"]]);
  }

  redirect("adminView.php");

$stmt -> close();
Database::dbDisconnect();
?>

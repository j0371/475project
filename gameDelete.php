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
  $query = "DELETE FROM game WHERE gameID = (?)";
  $stmt = $mysqli->prepare($query);
  $stmt -> execute($_GET["id"]);
  if($stmt){
    $_SESSION["message"] = "Deleted game";
  }else{
    $_SESSION["message"] = "Could not delete game";
  }
}
$stmt -> close();
Database::dbDisconnect();
?>

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

    $query1 = "DELETE FROM game_platform WHERE gameID = ?";
    $stmt1 = $mysqli->prepare($query1);
    $id = $_GET["id"];

    $stmt1->execute([$id]);
      echo "hello";
    if($stmt1){
      $_SESSION["message"] = "Deleted game_platform";
    }



  }

  redirect("adminView.php");

$stmt -> close();
Database::dbDisconnect();
?>

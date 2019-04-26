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

echo "<h3>Select an option</h3>";
echo "<div class='row'>";
echo "<label for='left-label' class='left inline'>";

echo "<form method=POST action=customerView.php>";
echo "Account Email:<input type=text name=Email />";
echo "<input type=submit class='button tiny round' value='Use Customer Account' />";
echo "</form>";

echo "<form action=customerCreate.php>";
echo "<input type=submit class='button tiny round' value='Create Customer Account' />";
echo "</form>";

echo "<form action=adminView.php>";
echo "<input type=submit class='button tiny round' value='Use Admin Account' />";
echo "</form>";
?>

<?php
class Database {
  private static $mysqli = null;

  public function __construct() {
    die('Init function error');
  }

  public static function dbConnect() {
  //try connecting to your database

    require_once("/home/dgonzal3/DBgonzalez.php");

    try{
      $mysqli = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME, USERNAME, PASSWORD);

    }catch (PDOException $e){
      echo "Could not connect";
    }


	//catch a potential error, if unable to connect


    return $mysqli;
  }

  public static function dbDisconnect() {
    $mysqli = null;
  }
}
?>

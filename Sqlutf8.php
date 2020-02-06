<?php
class Sqlutf8 extends PDO{

  private $conn;

  public function __construct(){

    $this->conn = new PDO("mysql:dbname=EXbase;host=localhost","EXnome","EXsenha");
    $this->conn->exec("set names utf8");

  }

  private function setParams($statement, $params){
    foreach ($params as $key => $value) {
      $this->setParam($statement,$key,$value);
    }
  }

  private function setParam($statement, $key, $value){
      $statement->bindParam($key,$value);
  }

  public function query($rawQuery, $params=array()){

    $stmt = $this->conn->prepare($rawQuery);

    $this->setParams($stmt, $params);

    $stmt->execute();

    return $stmt;

  }

  public function select($rawQuery, $params = array()):array{

    $stmt = $this->query($rawQuery,$params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  }

?>
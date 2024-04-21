<?php
 
class Database{
   
  private $hostName   = DB_HOST;
  private $dbName     = DB_NAME;
  private $dbUser     = DB_USER;
  private $dbPass     = DB_PASS;
  private $con;
  
  public function __construct(){
    $dsn='mysql:host=' . $this->hostName . ';dbname=' . $this->dbName;
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
      PDO::ATTR_CASE => PDO::CASE_LOWER
     );
    //Create PDO Instance
    try{
      $this->con = new PDO($dsn, $this->dbUser, $this->dbPass, $options);
    }catch(PDOException $e){
      $this->error = $e->getMessage();
      echo $this->error;
    }
  }
  
  public function insertData($tabel,$key,$value,$arr=[]){
    $sql = "INSERT INTO $tabel( $key ) VALUES ($value)";
    $stmt = $this->con->prepare($sql);
    if($stmt->execute($arr)){
      return true;
    }
  }
  
  public function updateData($tabel,$key,$where,$value=[]){
    $sql = "UPDATE $tabel SET $key WHERE $where";
    $stmt = $this->con->prepare($sql);
    if($stmt->execute($value)){
      return true;
    }
  }
  
  public function deleteData($tabel,$key,$value=[]){
    $sql = "DELETE FROM $tabel WHERE $key";
    $stmt = $this->con->prepare($sql);
    if($stmt->execute($value)){
      return true;
    }   
  }
  
  public function getData($select,$table,$where,$value=[],$fetch=null) {
	  $getstmet = $this->con->prepare("SELECT $select FROM $table WHERE $where");	
	  $getstmet->execute($value);
	  if($fetch){
	     return $getstmet->fetchAll();
	  }else{
	     return $getstmet->fetch();
	  }
  }
  
  public function getAllData($select,$table){
     $getstmet = $this->con->prepare("SELECT $select FROM $table");	
     $getstmet->execute();
     return $getstmet->fetchAll();
  }
  
  public function countData($count,$tabel) {
	  $stmet = $this->con->prepare("SELECT COUNT($count) FROM $tabel ");	
	  $stmet->execute();
	  return $stmet->fetchColumn();
  }
  
  public function checkfield($field,$tabel,$where,$value=[]) {
	  $stmet = $this->con->prepare("SELECT $field FROM $tabel WHERE $where");	
	  $stmet->execute($value);
 	  return $stmet->rowCount();
  }
  
}
 
?>
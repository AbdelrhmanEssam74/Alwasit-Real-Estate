<?php
class search extends DatabaseConnection
{
  public function search($query)
  {
    $prepare = $this->conn->prepare($query);
    $prepare->execute();
    $data = $prepare->fetchAll(PDO::FETCH_OBJ);
    return $data;
  }
}

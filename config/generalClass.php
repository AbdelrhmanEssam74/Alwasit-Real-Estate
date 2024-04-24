<?php

class GeneralClass extends DatabaseConnection
{
  public function select($query)
  {
    $select = $this->conn->prepare($query);
    $select->execute();
    $data = $select->fetchAll();
    return $data;
  }
  public function insert($query)
  {
    $insert = $this->conn->prepare($query);
    $r = $insert->execute();
    return $r;
  }
  public function delete($query)
  {
    $insert = $this->conn->prepare($query);
    $r = $insert->execute();
    return $r;
  }
  // get lasted 3 comments
  public function get_lasted_comments($property_id)
  {
    $sql = "SELECT * FROM `comments` INNER JOIN users ON users.user_id = comments.user_id WHERE `property_id` = '$property_id' ORDER BY `timestamp` DESC LIMIT 3";
    try {
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $data = $stmt->fetchAll();
      return $data;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  public function get_saved_num($id)
  {
    $stmt = $this->conn->prepare("SELECT COUNT(*) FROM `favorites` WHERE `fav_user_id` = '$id' AND `checked` = 1");
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;
  }
}

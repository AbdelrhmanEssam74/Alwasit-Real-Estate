<?php
class PropertyTable extends DatabaseConnection
{
  // method to get spacefic property by id
  public function getPropertyById($id)
  {
    $sql = "SELECT * FROM properties INNER JOIN owners ON properties.owner_id=owners.owner_id  WHERE properties.property_id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $property = $stmt->fetch(PDO::FETCH_OBJ);
    return $property;
  }
  public function getTopProperties()
  {
    $sql = "SELECT * FROM properties  INNER JOIN owners ON properties.owner_id = owners.owner_id LEFT JOIN favorites ON favorites.fav_property_id = properties.property_id Where properties.active = 1 AND properties.deleted = 0 LIMIT 3";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $properties;
  }
  public function getALLProperties()
  {
    $sql = "SELECT * FROM properties  INNER JOIN owners ON properties.owner_id = owners.owner_id  Where properties.active = 1 AND properties.deleted = 0 ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $properties;
  }
  public function getFavorateProperties($id)
  {
    $sql = "SELECT * FROM favorites INNER JOIN properties ON properties.property_id = favorites.fav_property_id Where favorites.checked = 1 AND favorites.fav_user_id = '$id'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $properties;
  }
  public function remove_fav($uid, $pid)
  {
    $sql = "DELETE FROM `favorites` WHERE `fav_user_id` = '$uid' AND `fav_property_id` = '$pid'";
    $stmt = $this->conn->prepare($sql);
    $r = $stmt->execute();
    return $r;
  }
}

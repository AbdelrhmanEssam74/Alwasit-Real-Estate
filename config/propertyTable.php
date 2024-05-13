<?php
class PropertyTable extends DatabaseConnection
{
  // method to get specific property by id
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
    $sql = "SELECT * FROM properties  INNER JOIN owners ON properties.owner_id = owners.owner_id LEFT JOIN favorites ON favorites.fav_property_id = properties.property_id Where properties.active = 1 AND properties.deleted = 0  ORDER BY `properties`.`uploaded_at` DESC LIMIT 3";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $properties;
  }
  public function getALLProperties($owner_id = null)
  {
    $sql = "SELECT * FROM properties  INNER JOIN owners ON properties.owner_id = owners.owner_id LEFT JOIN favorites ON favorites.fav_property_id = properties.property_id Where properties.active = 1 AND properties.deleted = 0 ";
    if ($owner_id != null) {
      $sql .= " AND properties.owner_id = '$owner_id'";
    }
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $properties;
  }
  public function getALLPropertiesBuyType($type = null, $order = "ASC", $column = "uploaded_at")
  {
    $sql = "SELECT * FROM properties INNER JOIN owners ON properties.owner_id = owners.owner_id LEFT JOIN favorites ON favorites.fav_property_id = properties.property_id WHERE properties.active = 1 AND properties.deleted = 0";

    if ($type != null) {
      $sql .= " AND properties.status = '$type'";
    }

    if ($order != null) {
      $sql .= " ORDER BY `properties`.`$column` $order";
    }
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
  public function GetContactedProperties($id)
  {
    $sql = "SELECT * FROM properties LEFT JOIN offers ON properties.property_id = offers.offer_property_id Where  offers.offer_user_id = '$id'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $properties;
  }
}

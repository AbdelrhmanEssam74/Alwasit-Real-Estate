<?php
class PropertyTable extends DatabaseConnection
{
  // method to get specific property by id
  public function getPropertyById($id)
  {
    $sql = "SELECT * FROM properties 
    INNER JOIN owners 
    ON properties.owner_id=owners.owner_id  
    WHERE properties.property_id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $property = $stmt->fetch(PDO::FETCH_OBJ);
    return $property;
  }

  // method to get top 3 properties based on upload date
  public function getTopProperties()
  {
    $sql = "SELECT * FROM properties
    INNER JOIN owners ON properties.owner_id = owners.owner_id
    LEFT JOIN favorites ON favorites.fav_property_id = properties.property_id
    WHERE properties.active = 1
    AND properties.deleted = 0
    ORDER BY RAND(), properties.uploaded_at DESC
    LIMIT 3";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $properties;
  }

  // method to get all properties (optional: filtered by owner)
  public function getALLProperties($owner_id = null)
  {
    $sql = "SELECT * FROM properties 
    INNER JOIN owners 
    ON properties.owner_id = owners.owner_id 
    LEFT JOIN favorites 
    ON favorites.fav_property_id = properties.property_id 
    Where properties.active = 1 
    AND properties.deleted = 0 
    AND properties.for_student != 1";

    if ($owner_id != null) {
      $sql .= " AND properties.owner_id = '$owner_id'";
    }

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $properties;
  }

  // method to get all properties of a specific type (optional: filtered by type and order)
  public function getALLPropertiesFurnished($order = "ASC", $column = "uploaded_at", $s = 0)
  {
    $sql = "SELECT * FROM properties 
    INNER JOIN owners 
    ON properties.owner_id = owners.owner_id 
    LEFT JOIN favorites 
    ON favorites.fav_property_id = properties.property_id 
    WHERE properties.active = 1 
    AND properties.deleted = 0
    AND properties.Furnished = 1";
    if ($s) {
      $sql .= " AND properties.for_student = 1";
    }
    if ($order != null) {
      $sql .= " ORDER BY `properties`.`$column` $order";
    }

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $properties;
  }
  public function getALLPropertiesCommercial($order = "ASC", $column = "uploaded_at")
  {
    $sql = "SELECT * FROM properties 
    INNER JOIN owners 
    ON properties.owner_id = owners.owner_id 
    LEFT JOIN favorites 
    ON favorites.fav_property_id = properties.property_id 
    WHERE properties.active = 1 
    AND properties.deleted = 0
    AND properties.for_commercial = 1";

    if ($order != null) {
      $sql .= " ORDER BY `properties`.`$column` $order";
    }
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $properties;
  }
  public function getALLPropertiesBuyType($type = null, $order = "ASC", $column = "uploaded_at")
  {
    $sql = "SELECT * FROM properties 
    INNER JOIN owners 
    ON properties.owner_id = owners.owner_id 
    LEFT JOIN favorites 
    ON favorites.fav_property_id = properties.property_id 
    WHERE properties.active = 1 
    AND properties.deleted = 0";

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

  // method to get favorite properties of a user
  public function getFavoriteProperties($id)
  {
    $sql = "SELECT * FROM favorites 
    INNER JOIN properties 
    ON properties.property_id = favorites.fav_property_id 
    Where favorites.checked = 1 
    AND favorites.fav_user_id = '$id'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $properties;
  }

  // method to remove a property from favorites
  public function remove_fav($uid, $pid)
  {
    $sql = "DELETE FROM `favorites` 
    WHERE `fav_user_id` = '$uid' 
    AND `fav_property_id` = '$pid'";
    $stmt = $this->conn->prepare($sql);
    $r = $stmt->execute();
    return $r;
  }

  // method to get properties that a user has contacted
  public function GetContactedProperties($id)
  {
    $sql = "SELECT * FROM properties 
    LEFT JOIN offers 
    ON properties.property_id = offers.offer_property_id 
    Where  offers.offer_user_id = '$id'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $properties;
  }
}

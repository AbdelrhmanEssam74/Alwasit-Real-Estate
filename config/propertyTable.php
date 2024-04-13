<?php
class PropertyTable extends DatabaseConnection
{
  // method to get spacefic property by id
  public function getPropertyById($id)
  {
    $sql = "SELECT * FROM properties INNER JOIN owners ON properties.owner_id=owners.owner_id WHERE properties.property_id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $property = $stmt->fetch(PDO::FETCH_OBJ);
    return $property;
  }
  public function getTopProperties()
  {
    $sql = "SELECT * FROM properties  INNER JOIN owners ON properties.owner_id = owners.owner_id Where properties.active = 1 AND properties.deleted = 0 LIMIT 3";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $properties = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $properties;
  }
}

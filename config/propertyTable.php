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
}

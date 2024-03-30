<?php

class EmailsTable extends DatabaseConnection
{
  public function generate_code(): string
  {
    $code = '';
    for ($i = 0; $i < 6; $i++) {
      $code .= mt_rand(0, 9); // Append a random digit (0-9)
    }
    $_SESSION['_wp_activation_code']  = $code;
    return $code;
  }
  public function insert($query, $data)
  {
    $insert = $this->conn->prepare($query);
    $r = $insert->execute($data);
    return $r;
  }
  public function GetByID($id)
  {
    $email = "SELECT * FROM `email_verification` WHERE user_id = :id ";
    $email = $this->conn->prepare($email);
    $email->execute(['id' => $id]);
    $data = $email->fetch(PDO::FETCH_ASSOC);
    return $data;
  }
  public function update($query, $arr)
  {
    $update = $this->conn->prepare($query);
    $r = $update->execute($arr);
    return $r;
  }

  // get the activation code from db

}

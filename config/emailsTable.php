<?php

class EmailsTable extends DatabaseConnection
{
    public function generate_activation_code(): string
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
    public function GetEmailByID($id)
    {
        $email = "SELECT `active` FROM `alwasit`.`email_verification` WHERE user_id = {$id} ";
        $email = $this->conn->prepare($email);
        $email->execute();
        return $email;
    }
    public function GetOneColumnById($id)
    {
        $active = "SELECT * FROM `email_verification` WHERE user_id = :id";
        $active = $this->conn->prepare($active);
        $active->bindParam(":id", $id);
        $active->execute();
        $data = $active->fetch(PDO::FETCH_ASSOC);
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


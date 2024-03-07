<?php

require 'config.php';
class RegisterTable extends DatabaseConnection
{
    public function insert($query, $arr, $path)
    {
        $insert = $this->conn->prepare($query);
        $insert->execute($arr);
        header("Location: $path");
    }
    public function update($query, $arr, $path)
    {
        $insert = $this->conn->prepare($query);
        $insert->execute($arr);
        header("Location: $path");
    }
    public function delete($query, $path)
    {

        $insert = $this->conn->prepare($query);
        $insert->execute();
        header("Location: $path");
    }
    public function checkPhoneNumber($num)
    {
        $regex = '/^(010|011|012|015)\d{8}$/';
        return preg_match($regex, $num);
    }
}

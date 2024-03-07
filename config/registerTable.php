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
}

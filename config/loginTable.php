<?php
class loginTable extends DatabaseConnection
{
    private $user_id;
    private $email;
    public function insert($query, $arr)
    {
        $insert = $this->conn->prepare($query);
        $r = $insert->execute($arr);
        return $r;
    }
    public function update($query, $arr)
    {
        $insert = $this->conn->prepare($query);
        $insert->execute($arr);
    }
    public function delete($query,)
    {
        $insert = $this->conn->prepare($query);
        $insert->execute();
    }
    public function checkIfUserExist($e)
    {
        $qry = "SELECT * FROM users WHERE email='" . $e . "'";
        $prepare = $this->conn->prepare($qry);
        $prepare->execute();
        return $prepare->rowCount();
    }
    public function checkPassword($e, $pass)
    {
        $qry = "SELECT * FROM users WHERE email='" . $e . "'";
        $prepare = $this->conn->prepare($qry);
        $prepare->execute();
        $rows = $prepare->fetch();
        $this->user_id = $rows['user_id'];
        return password_verify($pass,  $rows['Password']);
    }
    public function GetUserID()
    {
        return $this->user_id;
    }
}

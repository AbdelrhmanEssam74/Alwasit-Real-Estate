<?php
class loginTable extends DatabaseConnection
{
    private $user_id;
    private $email;
    private $token;
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
        $r = $insert->execute();
        return $r;
    }
    public function checkIfUserExist($e)
    {
        $qry = "SELECT * FROM users WHERE email='" . $e . "'";
        $prepare = $this->conn->prepare($qry);
        $prepare->execute();
        $rows = $prepare->fetch();
        $this->user_id = $rows['user_id'];
        $this->email = $rows['email'];
        return $prepare->rowCount();
    }

    public function checkPassword($e, $pass)
    {
        $qry = "SELECT * FROM users WHERE email='" . $e . "'";
        $prepare = $this->conn->prepare($qry);
        $prepare->execute();
        $rows = $prepare->fetch();

        return password_verify($pass,  $rows['Password']);
    }
    public function GetUserID(): string
    {
        return $this->user_id;
    }
    public function GetUserEmail()
    {
        return $this->email;
    }
    public function GetUserToken($id)
    {
        $qry = "SELECT * FROM `remmber_tokens` WHERE user_id='" . $id . "'";
        $prepare = $this->conn->prepare($qry);
        $prepare->execute();
        $rows = $prepare->fetch();
        return $rows;
    }
    public function getLoginUser($id)
    {
        $qry = "SELECT * FROM `login`
                INNER JOIN `remember_tokens` ON `login`.`user_id` = `remember_tokens`.`user_id`
                WHERE `login`.`user_id` = :id";
        $prepare = $this->conn->prepare($qry);
        $prepare->bindValue(':id', $id);
        $prepare->execute();
        $rows = $prepare->fetch();
        return $rows;
    }
}

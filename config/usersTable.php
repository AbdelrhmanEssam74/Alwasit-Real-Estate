<?php
class RegisterTable extends DatabaseConnection
{
    public function insert($query, $arr)
    {
        $insert = $this->conn->prepare($query);
        $r = $insert->execute($arr);
        return $r;
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
    public function checkEmail($e)
    {
        return (filter_var($e, FILTER_VALIDATE_EMAIL));
    }
    public function checkEmailExists($email)
    {
        $getEmailQuery = "SELECT * FROM users WHERE email = :email";
        $checkEmailExist = $this->conn->prepare($getEmailQuery);
        $checkEmailExist->bindParam(':email', $email);
        $checkEmailExist->execute();
        return $checkEmailExist->rowCount();
    }
    public function checkPhoneExists($phone)
    {
        $getPhoneQuery = "SELECT * FROM users WHERE user_phone = :phone";
        $checkPhoneExist = $this->conn->prepare($getPhoneQuery);
        $checkPhoneExist->bindParam(':phone', $phone);
        $checkPhoneExist->execute();
        return $checkPhoneExist->rowCount();
    }
    public function getAll()
    {
        $sql_query = "SELECT * FROM `users` where user_id = '65fc5b048e3bc'";
        $data = $this->conn->prepare($sql_query);
        $data->execute();
        $data = $data->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}

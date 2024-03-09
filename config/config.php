<?php

abstract class DatabaseConnection
{
    private $username = "Admin1";
    private $password = "a123";
    private $database_name = "alwasit";
    private $host = "localhost";
    protected $conn;
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database_name", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            include_once '../emails/index.php';
            $mailBody = "
                    <!DOCTYPE html>
                    <html>
                    <head>
                    </head>
                    <body>
                        <h1>Error in Database Connection</h1>
                        <p>An error occurred while connecting to the database:</p>
                        <p>Error message: {$e->getMessage()}</p>
                        <p>Please take necessary actions to resolve the issue.</p>
                        <p>Thank you.</p>
                    </body>
                    </html>
                            ";
            $send_email = new EmailSender("alwasit.real.estate@gmail.com", "DataBase Connection failed", $mailBody);
            $send_email->sendEmail();
            header("Location:../Not Found.php");
            exit();
        }
    }
}

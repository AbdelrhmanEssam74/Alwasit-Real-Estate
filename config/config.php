<?php


session_start();
class DatabaseConnection
{
    private $username = "Admin1";
    private $password = "a123";
    private $database_name = "alwasit";
    private $host = "localhost";

    public function __construct()
    {
        try {
            $DB_conn = new PDO("mysql:host=$this->host;dbname=$this->database_name", $this->username, $this->password);
            $DB_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
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
            // $_SESSION['DB_Error_mail'] = $mailBody;
            // header("Location:sendEmails.php");
            // exit();
        }
    }
}

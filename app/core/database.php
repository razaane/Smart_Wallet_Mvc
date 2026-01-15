<?php
class Database{
    private PDO $pdo;
    private static $instance;

    private function __construct($dsn,$username,$password)
    {
        try{
            $this->pdo = new pdo($dsn,$username,$password,[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }catch(PDOException $e){
            die("connexion has failed here is why :" .$e->getMessage());
        }
    }

    public static function getInstance(?string $dsn=null,?string $username=null , ?string $password=null){
        if(self::$instance===null){
            $dsn = $dsn ?? "mysql:host= localhost;dbname= SWallet ";
            $username = $username ?? "";
            $password = $password ?? "";
            
            self::$instance=new Database ($dsn,$username,$password);
        }

        return self::$instance;
    }

    public function getConnexion($pdo){
        return $this->pdo;
    }
    
}
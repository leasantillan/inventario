<?php 
    class db{
    //LOCALHOST
    private $dbLink = 'mysql:host=localhost;dbname=c1491167_sys_php';
    private $dbUser = 'root';
    private $dbPass = '';

    //Connection
    public function connDB(){
        $dbConn = new PDO($this->dbLink, $this->dbUser, $this->dbPass);
        $dbConn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $dbConn;
    }
}
?>
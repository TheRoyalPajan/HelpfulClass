
<?php
/**
 * @author pavel.vachaaa@gmail.com
 * @author Pavel Vácha
 * @version 1.0 
 * 
 *
 **/

class Database {

    protected $database;

    private $dbserver = "";
    private $dbuser = "";
    private $dbpass = "";
    private $dbname = "";

    public function __construct() {
        $this->database = $this->connectDatabase();
    }

    /**
     *
     * @return sql MSSQL Connetion u can  make your own method to connect.. it will work..
     */
    private function connectDatabase() {
        try {
            $conn = new \PDO("sqlsrv:Server=$this->dbserver;Database=$this->dbname", "$this->dbuser", "$this->dbpass", array("CharacterSet" => "UTF-8"));
            return $conn;
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    /**
     *
     * @param string SQL Query
     * @return array SQL Result
     */
    public function callQuery($query) {
        $prep = $this->database->prepare($query);
        try{
            $prep->execute();
            $result = $prep->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        }catch(\PDOException $e){
            print_r($e->getMessage());
            exit();
        }
    }

    /**
     *
     * @param string SQL Update query
     * @return mixed SQL Result
     */
    public function callQueryUpdate($query) {
        $prep = $this->database->prepare($query);
        $result = $prep->execute();
        return $result;
    }

    public function execQuery($q){
        $data =  $this->database->query($q);
        return $data;

    }

    public function fetchQuery($q){
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }

    //Prepared statements - 
    public function sendQuery($query, $par = array()) {
        $prep = $this->database->prepare($query);
        $prep->execute($par);
        $result = $prep;
        return $result;
    }



}
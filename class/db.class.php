<?php
use PDOException;

class db
{
    protected $connection;
    public $isConnected = false;
    private $errors = true;

    /**
     * PDO instance PDO for database connexion
     *
     * @param string $db_host
     * @param string $db_username
     * @param string $db_password
     * @param string $db_database
     */
    public function __construct($db_host, $db_username, $db_password, $db_database)
    {
        try {
            // Create DB connection
            $this->connection = new PDO("mysql:host=" . $db_host . ";dbname=" . $db_database, $db_username, $db_password);
            //Set a statement attribute
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $this->isConnected = true;
        } catch (PDOException $e) {
            $this->isConnected = false;
        }
    }

    /**
     * descrut connection
     * delete object from memory
     * liberate memory space
     *
     * @return void
     */
    public function close() : void
    {
        $this->isConnected = false;
        $this->connection = null;
    }

    /**
     * single select request from database
     *
     * @param string $query request to execute
     * @param array @parameters request params
     *
     * @return array|bool
     */
    public function fetch($query, $parameters = array())
    {
        if ($this->isConnected === true) {
            try {
                //Prepares a statement for execution and returns a statement object
                //protection from SQL injection
                $query = $this->connection->prepare($query);
                //Executes a prepared statement
                $query->execute($parameters);
                //Fetches the next row from a result set
                return $query->fetch();
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage());
            }
        } else {
            return false;
        }
    }

    /**
     * requete multiple select  from DB
     *
     * @param string $query la requete
     * @param array @parameters les param de la requete
     *
     * @return bool|array
     */
    public function fetchAll($query, $parameters = array())
    {
        if ($this->isConnected === true) {
            try {
                //Prepares a statement for execution and returns a statement object
                //protection from SQL injection
                $query = $this->connection->prepare($query);
                $query->execute($parameters);
                //Fetches the remaining rows from a result set
                return $query->fetchAll();
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage());
            }
        } else {
            return false;
        }
    }

    /**
     * exceute sql request
     *
     * @param string $query request to execute
     * @param array @parameters request params
     *
     * * @return bool|void
     */
    public function runQuery($query, $parameters = array())
    {
        if ($this->isConnected === true) {
            try {
                //Prepares a statement for execution and returns a statement object
                //protection from SQL injection
                $query = $this->connection->prepare($query);
                $query->execute($parameters);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage());
            }
        } else {
            return false;
        }
    }

    /**
     * check exist table on DB
     *
     * @param string $table name of table
     *
     * @return bool|int
     */
    public function tableExists($table)
    {
        if ($this->isConnected === true) {
            // Try a select statement against the table
            try {
                $result = $this->connection->query("SELECT 1 FROM $table LIMIT 1");
            } catch (PDOException $e) {
                // We got an exception (table not found)
                return false;
            }

            // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
            return $result !== false;
        } else {
            return false;
        }
    }

    /**
     * dump DB from file
     *
     * @param string $file path of dump file
     *
     * @return bool|void
     */
    public function dump($file)
    {
        if ($this->isConnected === true) {
            try {
                if (! preg_match_all("/('(\\\\.|.)*?'|[^;])+/s", file_get_contents($file), $m)) {
                    return;
                }
                // execute each request of the file (insert, create table..)
                foreach ($m[0] as $sql) {
                    if (strlen(trim($sql))) {
                        $query = $this->connection->prepare($sql);
                        $query->execute();
                    }
                }
                return true;
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage());
            }
        }
    }
}

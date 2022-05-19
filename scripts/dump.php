<?php
//Start a new session
session_start();
if (isset($_SESSION['login']) && $_SESSION['login']) {
    require_once('../class/db.class.php');
    //get database information from db config file
    $dbConfig = include '../config/db_config.php';
    //connection to database
    $db = new db($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);
    //run script on click reinstall button on setup IHM
    foreach ($dbConfig['tables'] as $table) {
        // check table existence
        if (!$db->tableExists($table)) {
            // dump table in not exist
            $dump = $db->dump('../sql/'.$table.'.sql');
        }
    }
    // descrut connection
    //liberate memory space
    $db->close();
}

<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login']) {
    require_once('../class/db.class.php');
    $dbConfig = include '../config/db_config.php';
    $db = new db($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);
    foreach ($dbConfig['tables'] as $table) {
        // check table existence
        if (!$db->tableExists($table)) {
            $dump = $db->dump('../sql/'.$table.'.sql');
        }
    }
    $db->close();
}

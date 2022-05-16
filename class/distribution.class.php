<?php

class Distribution{
    protected $db;
    private $table = 'distribution';
    function __construct($db) {
        $this->db = $db;
    }

    public function insert($data) {
        $query = 'INSERT INTO ' .$this->table . ' (idProduction, role, artiste) values (?, ?, ?)';
        $this->db->runQuery($query, $data);
    }
}
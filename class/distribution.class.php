<?php

class Distribution
{
    protected $db;
    private $table = 'distribution';
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * insert into distribution table
     *
     * @param array $data data to insert
     *
     * @return void
     */
    public function insert($data) : void
    {
        $query = 'INSERT INTO ' .$this->table . ' (idProduction, role, artiste) values (?, ?, ?)';
        $this->db->runQuery($query, $data);
    }
}

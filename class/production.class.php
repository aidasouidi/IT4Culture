<?php

class Production
{
    protected $db;
    private $table = 'productions';
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * get all production rows from database
     */
    public function getAll()
    {
        $query = 'SELECT * from ' .$this->table;
        return $this->db->fetchAll($query, []);
    }
    /**
    * get all production rows with associated dates and distribution
    */
    public function getAllWithDistAndDates()
    {
        $query = 'SELECT * from ' .$this->table;
        $res = $this->db->fetchAll($query, []);
        $result = [];
        foreach ($res as $item) {
            $item['distributions'] = $this->getProductionDistributionsById($item['id']);
            $item['dates'] = $this->getProductionDatesById($item['id']);
            $result[] = $item;
        }
        return $result;
    }

    /**
     * get all production rows by id with associated dates and distribution
     * @param integer $id the id of production
     */
    public function getByIdWithDistAndDates($id)
    {
        $query = 'SELECT * from ' .$this->table .' p where p.id = ?';
        $res = $this->db->fetch($query, [$id]);
        $res['distributions'] = $this->getProductionDistributionsById($id);
        $res['dates'] = $this->getProductionDatesById($id);

        return $res;
    }

    /**
     * get all distribution rows by id production
     * @param integer $id the id of production
     */
    private function getProductionDistributionsById($id)
    {
        $query = 'SELECT * from distribution where idProduction = ?';
        return $this->db->fetchAll($query, [$id]);
    }

    /**
     * get all production dates by id production
     * @param integer $id the id of production
     */
    private function getProductionDatesById($id)
    {
        $query = 'SELECT * from productions_dates where idProduction = ?';
        return $this->db->fetchAll($query, [$id]);
    }
}

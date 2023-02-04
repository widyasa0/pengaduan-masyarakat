<?php


class criticModel
{
    private $tablecritics = 'tb_critics';
    private $tablefeedback= 'tb_feedback';

    private $tbcitizen= 'tb_citizen';
    private $dbname = 'db_pengaduan_masyarakat';
    private $tablelevel = 'tb_level';

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function selectAllCritics()
    {
        $query = "SELECT * FROM db_pengaduan_masyarakat.{$this->tablecritics}";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultAll();

    }

    public function countCritics()
    {
        $query = "SELECT * FROM db_pengaduan_masyarakat.{$this->tablecritics}";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultAll();
    }

    public function countUnFeddbackCritic()
    {
        $query = "SELECT {$this->tablecritics}.`id_critics`, {$this->dbname}.{$this->tablefeedback}.`id_critics`
                FROM {$this->dbname}.{$this->tablecritics} LEFT JOIN {$this->dbname}.{$this->tablefeedback} ON 
                {$this->dbname}.{$this->tablecritics}.`id_critics` = {$this->dbname}.{$this->tablefeedback}.`id_critics`
                WHERE {$this->dbname}.{$this->tablefeedback}.`id_critics` IS NULL";

        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultAll();

    }  public function selectUnFeddbackCritic()
    {
        $query = "SELECT {$this->tablecritics}.id_critics, {$this->tbcitizen}.name, {$this->tablecritics}.id_citizen, {$this->tablefeedback}.id_critics,
                  {$this->tablecritics}.critic, {$this->tablecritics}.status,  {$this->tablecritics}.date
                FROM  {$this->tablecritics} INNER JOIN {$this->tbcitizen} ON {$this->tablecritics}.id_citizen = {$this->tbcitizen}.id_citizen LEFT JOIN {$this->tablefeedback} ON 
                {$this->tablecritics}.id_critics = {$this->tablefeedback}.id_critics
                WHERE {$this->tablecritics}.status = '0' ";

        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultAll();
    }



    public function selectCriticsById($id)
    {
        $query = "SELECT * FROM {$this->tablecritics} WHERE `citizen_id` = :citizen_id";
        $this->db->query($query);
        $this->db->execute();
        $this->db->resultSingle();
    }

    public function selectCriticsByCriticId($id)
    {

        $query = "SELECT * FROM {$this->tablecritics} WHERE `id_critics` = :id_critics";
        $this->db->bind('id_critics', $id);
        $this->db->query($query);
        return $this->db->resultSingle();

    }

    public function sendFeedback($data)
    {
//        $criticId = $this->selectCriticsByCriticId();
        $query = "INSERT INTO {$this->tablefeedback} VALUES (NULL, :status, :id_critics, :feedback, :date )";
        $this->db->query($query);
        $this->db->bind('status', '1');
        $this->db->bind('id_critics', $data['id_critics']);
        $this->db->bind('feedback', $data['feedback']);
        $this->db->bind('date', date("Y-m-d"));
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateStatusCritic($id)
    {
        $query = "UPDATE {$this->tablecritics} SET `status`='1' WHERE {$this->tablecritics}.id_critics = :id_critics";
        $this->db->query($query);
        $this->db->bind('id_critics', $id);
        $this->db->execute();
        return $this->db->rowCount();

    }
}


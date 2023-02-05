<?php

class feedbackModel{

    private $tablefeedback = 'tb_feedback';
    private $tbcitizen = 'tb_citizen';
    private $tbcritics = 'tb_critics';
    private $tablelevel = 'tb_level';

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function selectAllFeedback()
    {
        $query = "SELECT * FROM db_pengaduan_masyarakat.{$this->tablefeedback}";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultAll();

    }

    public function countFeedback()
    {
        $query = "SELECT * FROM db_pengaduan_masyarakat.{$this->tablefeedback}";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultAll();
    }

    public function selectFeedbackById($id)
    {
        $query = "SELECT * FROM {$this->tablefeedback} WHERE `feedback_id` = :feedback_id";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->resultSingle();
    }

    public function viewCriticSender()
    {
        $query = "SELECT {$this->tablefeedback}.id_feedback, {$this->tablefeedback}
                  .date, {$this->tbcitizen}.name, {$this->tbcritics}.critic, 
                 {$this->tablefeedback}.feedback,
                 {$this->tbcritics}.id_critics, 
                 {$this->tbcitizen}.id_citizen, {$this->tbcritics}.status, {$this->tablefeedback}.status FROM 
                 (({$this->tablefeedback}  INNER JOIN 
                  {$this->tbcritics} ON 
                  {$this->tablefeedback}.id_critics = 
                  {$this->tbcritics}.id_critics)
                  INNER JOIN {$this->tbcitizen} ON 
                  {$this->tbcitizen}.id_citizen
                  = {$this->tbcritics}.id_citizen)  
                 WHERE {$this->tablefeedback}.status='1'";
        $this->db->query($query);
        return $this->db->resultAll();
    }

    public function editFeedback($data)
    {
        $query = "UPDATE {$this->tablefeedback} SET `feedback`=:feedback WHERE `id_feedback`=:id_feedback";
        $this->db->query($query);
        $this->db->bind('id_feedback', $data['id_feedback']);
        $this->db->bind('feedback', $data['feedback']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function deleteFeedback($id)
    {
        $query = "DELETE FROM {$this->tablefeedback} WHERE `id_feedback`=:id_feedback";
        $this->db->query($query);
        $this->db->bind('id_feedback',$id);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function editStatusFeedback($id)
    {
        $query = "UPDATE {$this->tbcritics} INNER JOIN {$this->tablefeedback} ON {$this->tbcritics}.id_critics = {$this->tablefeedback}.id_critics SET {$this->tbcritics}.status = '1', {$this->tablefeedback}.status='1' WHERE {$this->tablefeedback}.id_feedback=:id_feedback";
        $this->db->query($query);
        $this->db->bind('status', '1');
        $this->db->bind('id_feedback',$id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function editStatus()
    {

    }

}



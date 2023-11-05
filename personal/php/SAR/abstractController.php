<?php
abstract class AbstractController 
{
    public RecordSource $recordSource;
    public AbstractModel $model;
    public Database $db;

    public function __construct(AbstractModel $model) 
    {
        $this->model = $model;
        $this->recordSource = new RecordSource();
        $this->recordSource->model = $model;
        $this->db = new Database($this->model);
        $this->db->connect();
        if (! $this->db->isConnected) 
        {
            echo("Connection Error");
            return;
        }
        $this->db->select();
        $this->recordSource =  $this->db->recordSource;
    }

    public function get($index,AbstractModel &$model) : AbstractModel
    {
        return $this->recordSource->get($index,$model);
    }

    public function recordCount() : int 
    {
        return $this->recordSource->recordCount();
    }

    public abstract function Style();
}
?>
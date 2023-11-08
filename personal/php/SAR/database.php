<?php
    class Database
    {
        public string $user = 'root';
        public string $password = 'root';
        public string $db = 'salvatoredb';
        public string $host = 'localhost';
        public int $port = 3306;
        public $conn;
        public bool $isConnected;
        public AbstractModel $model;
        public RecordSource $recordSource;

        function __construct(AbstractModel $model) 
        {
            $this->setModel($model);
        }

        public function connect() 
        {
            $this->conn = new mysqli( $this->host,  $this->user,  $this->password,  $this->db,  $this->port,"mysql");
            if ($this->conn->connect_error) 
            {
                die("Connection failed: " . $this->conn->connect_error);
                $this->isConnected = false;
            }
            $this->isConnected = true;
        }
        
        public function close()
        {
            try 
            {
                $this->conn -> close();
                $this->isConnected = false;
            }
            catch (Exception $e) 
            {
                echo "null";
            }
        }

        public function setModel(AbstractModel $model) 
        {
            $this->model = $model;
            $this->recordSource = new RecordSource($this->model);
        }

        public function select() 
        {
            $results = $this->conn->query($this->model->selectAll());
            while($row = $results->fetch_assoc())
                $this->recordSource->readRow($row);          
        }

        //i - integer
        //d - double
        //s - string
        //b - BLOB

        public function crud(int $query, &...$vars)
        {
            $id = 0;
            if (!$this->isConnected)
                $this->connect();
                switch ($query) 
                {
                    case 0:
                        $stmt = $this->conn->prepare($this->model->insertSQL());
                    break;
                    case 2:
                        $stmt = $this->conn->prepare($this->model->updateSQL());
                    break;
                    case 3:
                        $stmt = $this->conn->prepare($this->model->deleteSQL());
                    break;
                }

            if (!isset($stmt)) return -1;
            $stmt->bind_param($this->model->bindTypeParams($query),...$vars);
            $stmt->execute();
            $id = ($query==0) ? $stmt->insert_id : $stmt->affected_rows;
            $stmt->close();
            return $id;
        }

        function __destruct() 
        {
            try 
            {
                $this->close();
            }
            catch (Exception $e) 
            {
                    echo "null";
            }
        }
    }
?>
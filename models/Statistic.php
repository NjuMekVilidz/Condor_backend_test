<?php
    class Statistic {
        // Database connection
        private $connection;
        private $table = 'statistic';

        // Statistic properties from database
        public $id;
        public $page_url;
        public $user_ip_address;
        public $created_at;

        // Constructor
        public function __construct($database)
        {
            $this->connection = $database;
        }

        // Get statistic data
        public function getStatistic()
        {
            // Query for retrieving records from statistic table
            $query = 'SELECT * FROM api.statistic';
            
            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            return $stmt;
        }


    }
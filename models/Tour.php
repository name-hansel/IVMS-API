<?php
    class Tour {
        private $conn;
        private $table = 'tour';

        public $tour_id;
        public $name;
        public $branch;
        public $company_id;
        public $available_days;
        public $place;
        public $number_people;
        public $number_days;
        public $rate;
        public $description;
        public $avg_rating;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function getSampleTourData() {
            $query = 'SELECT tour_id, name, branch, place, rate FROM '.$this->table. ' WHERE company_id = ? LIMIT 4';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->company_id);
            $stmt->execute();

            return $stmt;
        }
    }
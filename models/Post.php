<?php
    class tour{
        private $conn;
        private $table= 'tour';
        public $tour_id;
        public $name;
        public $branch;
        public $company_id;
        public $available_days;
        public $place;
        public $rate;
        public $description;
        public $avg_rating;
    }

    function __contruct($db){
        $this->conn =$db;
    }
    
    function getSampleData(){
        $query = 'SELECT * FROM tour';
        $stmt= $this-> conn-> prepare($query);
        $stmt-> bindprogram(1, $this-> tour_id);
        $stmt-> execute(); 
        return $stmt;
    }
?>
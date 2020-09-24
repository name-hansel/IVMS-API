<?php
class STour
{
    private $conn;
    private $table = 'tour';
    public $tour_id;
    public $name;
    public $branch;
    public $company_id;
    public $available_days;
    public $place;
    public $rate;
    public $description;
    public $avg_rating;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getFromTour()
    {
        $query = 'SELECT * FROM tour';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}

<?php
class Tour
{
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

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getSampleCompanyTourData()
    {
        $query = 'SELECT tour_id, name, branch, place, rate FROM ' . $this->table . ' WHERE company_id = ? LIMIT 4';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->company_id);
        $stmt->execute();

        return $stmt;
    }

    public function postNewTour()
    {
        $d = "15-09-2020";
        $query = "INSERT INTO tour(name, branch, company_id, available_days, place, number_people, number_days, rate, description) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->branch);
        $stmt->bindParam(3, $this->company_id);
        $stmt->bindParam(4, $d);
        $stmt->bindParam(5, $this->place);
        $stmt->bindParam(6, $this->number_people);
        $stmt->bindParam(7, $this->number_days);
        $stmt->bindParam(8, $this->rate);
        $stmt->bindParam(9, $this->description);

        $stmt->execute();
        return $stmt;
    }

    function getFromTour()
    {
        $query = 'SELECT * FROM tour';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}

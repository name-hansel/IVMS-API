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
    public $rate;
    public $description;
    public $avg_rating;
    public $created_at;
    public $edited_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getSampleCompanyTourData()
    {
        $query = 'SELECT tour_id, name, branch, place, rate FROM ' . $this->table . ' WHERE company_id = ? LIMIT 3';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->company_id);
        $stmt->execute();

        return $stmt;
    }

    public function postNewTour()
    {
        $query = "INSERT INTO tour(name, branch, company_id, available_days, place, number_people, rate, description) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->branch);
        $stmt->bindParam(3, $this->company_id);
        $stmt->bindParam(4, $this->available_days);
        $stmt->bindParam(5, $this->place);
        $stmt->bindParam(6, $this->number_people);
        $stmt->bindParam(7, $this->rate);
        $stmt->bindParam(8, $this->description);

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
    
    public function getCompanyTours()
    {
        $query = 'SELECT tour_id, name, branch, available_days, place, number_people, rate, description, avg_rating, created_at, edited_at  FROM ' . $this->table . ' WHERE company_id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->company_id);
        $stmt->execute();

        return $stmt;
    }

    public function getHomeTour()
    {
        $query = 'SELECT name,description FROM tour';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function putEditTour() {
        // name, branch, available_days, place, number_people, rate, description, edited_at
        $query = 'UPDATE tour SET
        name = ?, branch = ?, available_days = ?, place = ?, number_people = ?, rate = ?, description = ?, edited_at = NOW()
        WHERE tour_id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->branch);
        $stmt->bindParam(3, $this->available_days);
        $stmt->bindParam(4, $this->place);
        $stmt->bindParam(5, $this->number_people);
        $stmt->bindParam(6, $this->rate);
        $stmt->bindParam(7, $this->description);
        $stmt->bindParam(8, $this->tour_id);

        $stmt->execute();
        return $stmt;
    }

    public function getInfoAllTours()
    {
        $query = 'SELECT t.tour_id, t.name, t.branch, c.company, t.place, t.description, t.avg_rating FROM tour t inner join company c on t.company_id=c.company_id';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}

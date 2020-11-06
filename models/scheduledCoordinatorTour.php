<?php
class scheduledCoordinatorTour
{
    private $conn;
    private $table = 'btour';

    public $btour_id;
    public $tour_id;
    public $user_id;
    public $number_people;
    public $date;
    public $rating;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    
    public function scheduledCoordinatorTour()
    {
        $query = "INSERT INTO btour(btour_id, tour_id, user_id, number_people, date, rating) VALUES (?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->btour_id);
        $stmt->bindParam(2, $this->tour_id);
        $stmt->bindParam(3, $this->user_id);
        $stmt->bindParam(4, $this->number_people);
        $stmt->bindParam(5, $this->date);
        $stmt->bindParam(6, $this->rating);
        $stmt->execute();
        return $stmt;
    }
    
    function postCoordinatorBookedTour()
    {
        $query = 'SELECT * FROM btour';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

}

   
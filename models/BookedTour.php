<?php
class BookedTour
{
    private $conn;
    private $table = 'btour';

    public $btour_id;
    public $tour_id;
    public $user_id;
    public $number_people;
    public $rating;
    public $booked_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function getSampleCompanyBookedTourData()
    {
        $query = 'SELECT btour_id, btour.tour_id, btour.user_id, tour.name, coordinator.college, tour.available_days 
        FROM btour INNER JOIN tour 
        ON tour.tour_id = btour.tour_id 
        INNER JOIN coordinator
        ON coordinator.user_id = btour.user_id
        WHERE (tour.company_id = ? AND tour.available_days > CURRENT_DATE) LIMIT 3';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->company_id);
        $stmt->execute();

        return $stmt;
    }

    public function getPastCoordinatorTours()
    {
        // TODO fix query to match updated columns, get tour name, company name, and date (from tour table)
        $query = 'SELECT btour_id, tour_id, user_id, date FROM btour WHERE btour_id < 10006';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getCompanyBookedTours()
    {
        $query = 'SELECT btour_id, btour.tour_id, btour.user_id, tour.name, coordinator.college, tour.available_days, btour.booked_at, btour.number_people FROM btour INNER JOIN tour 
        ON tour.tour_id = btour.tour_id 
        INNER JOIN coordinator
        ON coordinator.user_id = btour.user_id
        WHERE (tour.company_id = ? AND tour.available_days > CURRENT_DATE)';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->company_id);
        $stmt->execute();

        return $stmt;
    }

    public function getCompanyPastTours()
    {
        $query = 'SELECT btour_id, btour.tour_id, btour.user_id, tour.name, coordinator.college, tour.available_days, btour.booked_at, btour.number_people, btour.rating FROM btour INNER JOIN tour 
        ON tour.tour_id = btour.tour_id 
        INNER JOIN coordinator
        ON coordinator.user_id = btour.user_id
        WHERE (tour.company_id = ? AND tour.available_days < CURRENT_DATE)';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->company_id);
        $stmt->execute();

        return $stmt;
    }

    public function getInfoPastTours()
    {
        $query = 'SELECT b.btour_id,c.college,t.name,b.date,b.rating,b.number_people,a.company
        from btour b inner join tour t on b.tour_id=t.tour_id inner join coordinator c
        on b.user_id=c.user_id inner join company a on t.company_id=a.company_id
        where b.date < current_date;';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function scheduledCoordinatorTour()
    {
        $query = "INSERT INTO btour(tour_id, user_id, number_people) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->tour_id);
        $stmt->bindParam(2, $this->user_id);
        $stmt->bindParam(3, $this->number_people);

        $stmt->execute();
        return $stmt;
    }

    public function getCoordinatorPastTours(){
        $query = 'SELECT btour_id, btour.tour_id, btour.user_id, tour.name,tour.available_days, btour.number_people, btour.rating FROM btour INNER JOIN tour 
        ON tour.tour_id = btour.tour_id 
        WHERE (tour.user_id = ?)';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->user_id);
        $stmt->execute();

        return $stmt;
    }

    public function postTourRating(){

        $query = "INSERT INTO btour(rating) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->rating);
        $stmt->execute();
        return $stmt;
    }
}

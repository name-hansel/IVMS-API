<?php
class BookedTour
{
    private $conn;
    private $table = 'btour';

    public $btour_id;
    public $tour_id;
    public $user_id;
    public $college;
    public $date;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function getSampleCompanyBookedTourData()
    {
        //FIX query problem -> duplicates each btour
        $query = 'SELECT btour_id, btour.tour_id, btour.user_id,        coordinator.college, date 
        FROM btour INNER JOIN tour 
        ON tour.tour_id = btour.tour_id 
        INNER JOIN coordinator
        ON coordinator.user_id = btour.user_id
        WHERE (tour.company_id = ? AND btour.date > CURRENT_DATE) 
        LIMIT 4';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->company_id);
        $stmt->execute();

        return $stmt;
    }
}
